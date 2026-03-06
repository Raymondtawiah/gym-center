<?php

namespace App\Http\Controllers;

use App\Models\GymClass;
use App\Models\ClassBooking;
use App\Http\Requests\ClassBookingRequest;
use App\Http\Resources\GymClassResource;
use App\Http\Resources\ClassBookingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymClassController extends Controller
{
    public function index(Request $request)
    {
        // Get the user's gym
        $gymId = null;
        if (auth()->check()) {
            $gymId = auth()->user()->gym_id;
        }
        
        // Always get bookings for authenticated users
        $bookings = collect();
        if (auth()->check()) {
            $bookings = ClassBooking::where('user_id', auth()->id())
                ->where('status', 'confirmed')
                ->with('gymClass')
                ->orderBy('booking_date')
                ->get();
        }
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            $query = GymClass::where('is_active', true);
            
            if ($gymId) {
                $query->where(function ($q) use ($gymId) {
                    $q->whereNull('gym_id')->orWhere('gym_id', $gymId);
                });
            }
            
            $classes = $query->orderBy('day_of_week')
                ->orderBy('start_time')
                ->get();
                
            return GymClassResource::collection($classes);
        }
        
        // Get all available classes
        $query = GymClass::where('is_active', true);
        
        if ($gymId) {
            $query->where(function ($q) use ($gymId) {
                $q->whereNull('gym_id')->orWhere('gym_id', $gymId);
            });
        }
        
        $classes = $query->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
            
        return view('pages.classes', [
            'classes' => $classes,
            'bookings' => $bookings,
            'isBookingView' => false
        ]);
    }

    public function myClasses(Request $request)
    {
        $user = Auth::user();
        
        $bookings = ClassBooking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->with('gymClass')
            ->orderBy('booking_date')
            ->get();
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return ClassBookingResource::collection($bookings);
        }
        
        return view('pages.classes', [
            'classes' => collect(),
            'bookings' => $bookings,
            'isBookingView' => true
        ]);
    }

    public function book(ClassBookingRequest $request)
    {
        $user = Auth::user();
        $gymId = $user->gym_id;
        
        // Check if admin is booking for someone else
        $isAdmin = $user->is_admin ?? false;
        $targetUserId = $user->id;
        
        // If admin and user_id is provided, book for that user
        if ($isAdmin && $request->has('user_id') && $request->user_id) {
            $targetUser = \App\Models\User::findOrFail($request->user_id);
            $targetUserId = $targetUser->id;
            // Use the target user's gym
            $gymId = $targetUser->gym_id;
        }
        
        $gymClass = GymClass::findOrFail($request->gym_class_id);
        
        // Ensure class belongs to user's gym
        if ($gymId && $gymClass->gym_id !== $gymId && $gymClass->gym_id !== null) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You can only book classes from your gym.'], 422);
            }
            return back()->with('error', 'You can only book classes from your gym.');
        }
        
        // Check if class is full
        $currentBookings = ClassBooking::where('gym_class_id', $request->gym_class_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', 'confirmed')
            ->count();

        if ($currentBookings >= $gymClass->capacity) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'This class is fully booked.'], 422);
            }
            return back()->with('error', 'This class is fully booked.');
        }

        // Create booking with gym_id
        $booking = ClassBooking::create([
            'user_id' => $targetUserId,
            'gym_class_id' => $request->gym_class_id,
            'booking_date' => $request->booking_date,
            'status' => 'confirmed',
            'gym_id' => $gymClass->gym_id ?? $gymId,
        ]);
        
        $booking->load(['gymClass', 'user']);
        
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Class booked successfully!',
                'booking' => new ClassBookingResource($booking)
            ], 201);
        }
        
        return back()->with('success', 'Class booked successfully!');
    }
}
