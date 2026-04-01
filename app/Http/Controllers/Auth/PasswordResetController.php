<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetController extends Controller
{
    /**
     * Show the password reset request form.
     */
    public function showRequestForm()
    {
        return view('pages.auth.forgot-password');
    }

    /**
     * Send password reset verification code.
     */
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }

        // Generate 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store verification code in session or database
        session([
            'password_reset_code' => $verificationCode,
            'password_reset_email' => $request->email,
            'password_reset_expires' => now()->addMinutes(10)
        ]);

        // Send email with verification code
        Mail::raw(
            "Your password reset verification code is: {$verificationCode}\n\nThis code will expire in 10 minutes.",
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Password Reset Verification Code - GymCenter');
            }
        );

        return redirect()->route('password.reset.verify')->with('status', 'verification-code-sent');
    }

    /**
     * Show the verification code form.
     */
    public function showVerificationForm()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('pages.auth.password-reset-verify');
    }

    /**
     * Verify the reset code.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|digits:6'
        ]);

        // Check if code matches and hasn't expired
        if (
            session('password_reset_code') !== $request->verification_code ||
            now()->greaterThan(session('password_reset_expires'))
        ) {
            return back()->withErrors(['verification_code' => 'Invalid or expired verification code.']);
        }

        // Mark as verified and redirect to new password form
        session([
            'password_reset_verified' => true,
            'password_reset_verified_at' => now()
        ]);

        return redirect()->route('password.reset.new', [
            'email' => session('password_reset_email')
        ]);
    }

    /**
     * Resend verification code.
     */
    public function resendCode(Request $request)
    {
        $email = session('password_reset_email') ?: $request->email;
        
        if (!$email) {
            return redirect()->route('password.request');
        }

        // Generate new code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Update session
        session([
            'password_reset_code' => $verificationCode,
            'password_reset_expires' => now()->addMinutes(10)
        ]);

        // Send new email
        Mail::raw(
            "Your new password reset verification code is: {$verificationCode}\n\nThis code will expire in 10 minutes.",
            function ($message) use ($email) {
                $message->to($email)
                    ->subject('New Password Reset Verification Code - GymCenter');
            }
        );

        return back()->with('status', 'verification-code-sent');
    }

    /**
     * Show the new password form.
     */
    public function showNewPasswordForm()
    {
        if (!session('password_reset_verified')) {
            return redirect()->route('password.reset.verify');
        }

        return view('pages.auth.password-reset-new');
    }

    /**
     * Set the new password.
     */
    public function setNewPassword(Request $request)
    {
        if (!session('password_reset_verified')) {
            return redirect()->route('password.reset.verify');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid email address.']);
        }

        // Update password
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        // Clear all password reset sessions
        session()->forget([
            'password_reset_code',
            'password_reset_email',
            'password_reset_verified',
            'password_reset_verified_at',
            'password_reset_expires'
        ]);

        return redirect()->route('login')
            ->with('status', 'password-reset-success')
            ->with('message', 'Your password has been successfully reset. Please log in with your new password.');
    }
}
