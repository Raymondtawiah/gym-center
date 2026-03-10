<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\LogoutResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is approved - show toast message for clients
            if (!$user->isApproved()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Show toast message but stay on login page
                return back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Your account is pending approval. Please contact the administrator.'
                ])->onlyInput('email');
            }
            
            // Always send verification code for admin and staff
            if ($user->role === 'admin' || $user->role === 'staff') {
                // Get gym name
                $gymName = 'GymCenter';
                if ($user->gym) {
                    $gymName = $user->gym->name;
                }
                
                // Send verification email
                $user->notify(new \App\Notifications\LoginVerificationNotification($gymName));
                
                // Redirect to verification page
                return redirect()->route('login.verify');
            }
            
            // Check if email is verified for clients - if not, send verification email and redirect
            if (!$user->email_verified_at) {
                // Get gym name
                $gymName = 'GymCenter';
                if ($user->gym) {
                    $gymName = $user->gym->name;
                }
                
                // Send verification email
                $user->notify(new \App\Notifications\LoginVerificationNotification($gymName));
                
                // Redirect to verification page
                return redirect()->route('login.verify');
            }
            
            // Set welcome message in session
            if ($user->role === 'admin') {
                $request->session()->flash('success', 'Welcome back, Admin! ' . $user->name);
            } else {
                $request->session()->flash('success', 'Welcome back, ' . $user->name . '!');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): LogoutResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }
}
