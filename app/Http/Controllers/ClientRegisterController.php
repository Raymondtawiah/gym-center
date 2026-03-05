<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegisterRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ClientRegisterController extends Controller
{
    public function store(ClientRegisterRequest $request)
    {
        // Check if this is the first user - first user becomes admin
        $isFirstUser = User::count() === 0;
        $role = $isFirstUser ? 'admin' : 'client';

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
        ]);

        Auth::login($user);

        // Different welcome message for admin vs client
        if ($isFirstUser) {
            return redirect()->route('dashboard')->with('success', 'Welcome, Admin! You are the first user and have been granted admin privileges.');
        }

        return redirect()->route('dashboard')->with('success', 'Welcome to GymCenter! Your account has been created successfully.');
    }
}
