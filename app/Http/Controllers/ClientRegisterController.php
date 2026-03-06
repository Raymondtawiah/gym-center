<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ClientRegisterController extends Controller
{
    public function store(ClientRegisterRequest $request)
    {
        // Get the authenticated user's gym (for admin/staff registering clients)
        $gymId = null;
        
        if (auth()->check()) {
            $user = auth()->user();
            // Only admins and staff can register clients to a gym
            if ($user->isAdmin() || $user->isStaff()) {
                $gymId = $user->gym_id;
            }
        }

        // If no gym_id from auth, check if there's a gym to assign to
        if (!$gymId) {
            // Get the first gym (for demo purposes - in production, clients would select a gym)
            $gym = \App\Models\Gym::first();
            if ($gym) {
                $gymId = $gym->id;
            }
        }

        // Create the user (don't log in automatically)
        // Admins register clients - role is always 'client'
        $role = 'client';

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'membership_type' => $request->membership_type,
            'role' => $role,
            'is_approved' => true, // All clients registered by admin are auto-approved
            'gym_id' => $gymId,
        ]);

        // Redirect back to admin users page with success toast message
        return redirect()->route('admin.users.index')->with('toast', [
            'type' => 'success',
            'message' => 'Client registered successfully!'
        ]);
    }
}
