<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GymController extends Controller
{
    /**
     * Show gym settings page.
     */
    public function settings()
    {
        $user = auth()->user();
        $gym = Gym::findOrFail($user->gym_id);
        
        return view('admin.gym.settings', compact('gym'));
    }

    /**
     * Update gym settings.
     */
    public function update(Request $request, Gym $gym)
    {
        $user = auth()->user();
        
        // Ensure user owns this gym
        if ($user->gym_id !== $gym->id) {
            return back()->with('error', 'You can only manage your own gym.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:gyms,slug,' . $gym->id],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $gym->update($request->only(['name', 'slug', 'email', 'phone', 'address']));

        return back()->with('success', 'Gym settings updated successfully.');
    }

    /**
     * Show staff management page.
     */
    public function staff()
    {
        $user = auth()->user();
        $gymId = $user->gym_id;
        
        $staff = User::where('gym_id', $gymId)
            ->where('role', 'staff')
            ->orderBy('name')
            ->get();
            
        return view('admin.gym.staff', compact('staff'));
    }

    /**
     * Add a new staff member.
     */
    public function addStaff(Request $request)
    {
        $user = auth()->user();
        $gymId = $user->gym_id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'gym_id' => $gymId,
            'is_approved' => true, // Staff are auto-approved
        ]);

        return back()->with('success', 'Staff member added successfully.');
    }

    /**
     * Remove a staff member.
     */
    public function removeStaff(User $user)
    {
        $currentUser = auth()->user();
        
        // Ensure user belongs to the same gym
        if ($user->gym_id !== $currentUser->gym_id) {
            return back()->with('error', 'You can only manage staff in your gym.');
        }

        if ($user->role !== 'staff') {
            return back()->with('error', 'Only staff members can be removed.');
        }

        $user->delete();

        return back()->with('success', 'Staff member removed successfully.');
    }
}
