<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassBooking;
use App\Models\GymClass;
use App\Models\User;
use App\Http\Resources\ClassBookingResource;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display client's own bookings/memberships.
     */
    public function myBookings(Request $request)
    {
        $user = auth()->user();
        
        $query = ClassBooking::with(['gym'])
            ->where('user_id', $user->id);
        
        // Filter by membership type
        if ($request->has('type') && $request->type) {
            $query->where('membership_type', $request->type);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by year
        if ($request->has('year') && $request->year) {
            $query->whereYear('start_date', $request->year);
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')
            ->paginate(10);
            
        return view('client.bookings', compact('bookings', 'user'));
    }

    /**
     * Display booking details with health information.
     */
    public function showBooking(ClassBooking $booking)
    {
        // Ensure the user can only view their own bookings
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        
        $booking->load(['gym', 'user']);
        
        return view('client.booking-details', compact('booking'));
    }

    /**
     * Show form to create a new booking.
     */
    public function create(Request $request)
    {
        $gymId = auth()->user()->gym_id;
        
        // Get users for the gym (or all users if super admin)
        $users = User::where('role', 'client')
            ->when($gymId, function ($query) use ($gymId) {
                return $query->where('gym_id', $gymId);
            })
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();
            
        return view('admin.bookings.create', compact('users'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'membership_type' => 'required|in:monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $user = User::findOrFail($request->user_id);
        $gymId = auth()->user()->gym_id ?? $user->gym_id;
        
        // Update client health information if provided
        $user->update(array_filter([
            'weight' => $request->weight,
            'height' => $request->height,
            'health_conditions' => $request->health_conditions,
            'allergies' => $request->allergies,
            'medications' => $request->medications,
            'fitness_goals' => $request->fitness_goals,
            'injuries' => $request->injuries !== '' ? $request->injuries : null,
            'injury_details' => $request->injury_details,
        ]));
        
        // Create membership booking
        $booking = ClassBooking::create([
            'user_id' => $request->user_id,
            'gym_class_id' => null, // No class - this is a membership
            'booking_date' => $request->start_date,
            'status' => 'confirmed',
            'gym_id' => $gymId,
            // Membership fields
            'membership_type' => $request->membership_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes,
        ]);
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Membership created successfully!');
    }

    /**
     * Display a list of all class bookings.
     */
    public function index(Request $request)
    {
        $gymId = auth()->user()->gym_id;
        
        $query = ClassBooking::with(['user', 'gymClass', 'gym']);
        
        // Filter by gym if user belongs to a gym
        if ($gymId) {
            $query->where('gym_id', $gymId);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->where('booking_date', $request->date);
        }
        
        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return ClassBookingResource::collection($bookings);
        }
            
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Display a specific booking.
     */
    public function show(ClassBooking $booking, Request $request)
    {
        $booking->load(['user', 'gymClass', 'gym']);
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return new ClassBookingResource($booking);
        }
        
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Update the status of a booking.
     */
    public function updateStatus(Request $request, ClassBooking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed'
        ]);
        
        $booking->update([
            'status' => $request->status
        ]);
        
        $booking->load(['user', 'gymClass', 'gym']);
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Booking status updated successfully.',
                'booking' => new ClassBookingResource($booking)
            ]);
        }
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove a booking.
     */
    public function destroy(ClassBooking $booking, Request $request)
    {
        $booking->delete();
        
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Booking deleted successfully.'
            ]);
        }
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Display printable booking form.
     */
    public function printForm(Request $request)
    {
        $user = auth()->user();
        $gymId = $user->gym_id;
        
        // Get the gym information
        $gym = \App\Models\Gym::find($gymId);
        
        return view('admin.bookings.print-form', compact('gym'));
    }
}
