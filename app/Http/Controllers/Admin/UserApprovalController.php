<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /**
     * Display a list of users.
     */
    public function index()
    {
        $user = auth()->user();
        $gymId = $user->gym_id;

        // Get all client users for the gym
        $users = User::where('gym_id', $gymId)
            ->where('role', 'client')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display a specific user's details.
     */
    public function show(User $user)
    {
        $currentUser = auth()->user();
        $gymId = $currentUser->gym_id;

        // Ensure user belongs to the same gym
        if ($user->gym_id !== $gymId) {
            return back()->with('error', 'You can only view users in your gym.');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        $currentUser = auth()->user();
        $gymId = $currentUser->gym_id;

        // Ensure user belongs to the same gym
        if ($user->gym_id !== $gymId) {
            return back()->with('error', 'You can only manage users in your gym.');
        }

        $user->update(['is_approved' => true]);

        return back()->with('success', "{$user->name} has been approved successfully.");
    }

    /**
     * Disapprove (revoke approval) a user.
     */
    public function disapprove(User $user)
    {
        $currentUser = auth()->user();
        $gymId = $currentUser->gym_id;

        // Ensure user belongs to the same gym
        if ($user->gym_id !== $gymId) {
            return back()->with('error', 'You can only manage users in your gym.');
        }

        $user->update(['is_approved' => false]);

        return back()->with('success', "{$user->name} has been disapproved.");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();
        $gymId = $currentUser->gym_id;

        // Ensure user belongs to the same gym
        if ($user->gym_id !== $gymId) {
            return back()->with('error', 'You can only manage users in your gym.');
        }

        if ($user->isAdmin()) {
            return back()->with('error', 'Admin users cannot be deleted.');
        }

        $user->delete();

        return back()->with('success', 'User has been deleted successfully.');
    }
}
