<?php

namespace App\Http\Controllers;

use App\Models\GymClass;
use App\Models\ClassBooking;
use App\Http\Requests\ClassBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
            
        return view('pages.classes', compact('classes'));
    }

    public function book(ClassBookingRequest $request)
    {
        $gymClass = GymClass::findOrFail($request->gym_class_id);
        
        // Check if class is full
        $currentBookings = ClassBooking::where('gym_class_id', $request->gym_class_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', 'confirmed')
            ->count();

        if ($currentBookings >= $gymClass->capacity) {
            return back()->with('error', 'This class is fully booked.');
        }

        // Create booking
        ClassBooking::create([
            'user_id' => Auth::id(),
            'gym_class_id' => $request->gym_class_id,
            'booking_date' => $request->booking_date,
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Class booked successfully!');
    }
}
