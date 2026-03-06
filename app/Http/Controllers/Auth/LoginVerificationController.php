<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginVerificationController extends Controller
{
    /**
     * Show the login verification page with code entry.
     */
    public function show(): View
    {
        $user = Auth::user();
        $gymName = 'GymCenter';
        
        // Get the gym name if user belongs to a gym
        if ($user && $user->gym) {
            $gymName = $user->gym->name;
        }
        
        // Generate and store a new verification code
        $code = $this->generateAndStoreCode($user);
        
        // Send the code via email
        $user->notify(new \App\Notifications\LoginVerificationNotification($gymName, $code));
        
        return view('pages.auth.login-verify', compact('gymName'));
    }

    /**
     * Generate and store verification code.
     */
    private function generateAndStoreCode(User $user): string
    {
        // Generate a 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store the code in the session temporarily
        session(['verification_code' => $code]);
        session(['verification_code_expires' => now()->addMinutes(10)]);
        
        return $code;
    }

    /**
     * Verify the code entered by user.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'verification_code' => 'required|digits:6',
        ]);
        
        $sessionCode = session('verification_code');
        $expires = session('verification_code_expires');
        
        // Check if code exists and hasn't expired
        if (!$sessionCode || !$expires || now()->greaterThan($expires)) {
            // Code expired - redirect to resend
            return redirect()->route('login.verify')->with('error', 'Verification code has expired. Please request a new one.');
        }
        
        // Verify the code
        if ($request->verification_code !== $sessionCode) {
            return back()->with('error', 'Invalid verification code. Please try again.');
        }
        
        // Mark email as verified
        $user = Auth::user();
        $user->email_verified_at = $user->freshTimestamp();
        $user->save();
        
        // Clear the verification code from session
        session()->forget(['verification_code', 'verification_code_expires']);
        
        // Redirect to dashboard with success message
        return redirect('/dashboard')->with('success', 'Email verified successfully!');
    }

    /**
     * Resend the verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Get the gym name
        $gymName = 'GymCenter';
        if ($user->gym) {
            $gymName = $user->gym->name;
        }
        
        // Generate and send a new code
        $code = $this->generateAndStoreCode($user);
        $user->notify(new \App\Notifications\LoginVerificationNotification($gymName, $code));
        
        return back()->with('status', 'verification-code-sent');
    }
}
