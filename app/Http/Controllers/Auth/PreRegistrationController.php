<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PreRegistrationController extends Controller
{
    /**
     * Show the default login page for pre-registration.
     */
    public function showLogin(): View
    {
        return view('pages.auth.pre-register-login');
    }

    /**
     * Handle the default login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $defaultUser = User::where('email', $credentials['email'])->where('role', 'admin')->first();

        // Check if the credentials match a seeded default admin
        if ($defaultUser && Hash::check($credentials['password'], $defaultUser->password)) {
            // Store session flag indicating this is a pre-registration login
            $request->session()->put('pre_registration_login', true);
            $request->session()->put('pre_registration_started', now());

            // Generate a 6-digit verification code
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Store code in session
            $request->session()->put('owner_verification_code', $code);
            $request->session()->put('owner_verification_expires', now()->addMinutes(10));

            // Get owner email
            $ownerEmail = config('app.owner_email', 'raymondtawiah23@gmail.com');

            // Log the code for debugging
            \Illuminate\Support\Facades\Log::info('Owner verification code generated: ' . $code . ' for pre-registration from IP: ' . $request->ip());

            // Send email to owner
            try {
                Mail::send('emails.owner-verification-code', [
                    'code' => $code,
                    'ip' => $request->ip(),
                    'time' => now()->format('Y-m-d H:i:s')
                ], function ($message) use ($ownerEmail) {
                    $message->to($ownerEmail)
                        ->subject('New Registration Verification Code - GymCenter');
                });
            } catch (\Exception $e) {
                // Log error but continue
                \Illuminate\Support\Facades\Log::error('Failed to send owner verification email: ' . $e->getMessage());
            }

            // Redirect to owner verification page
            return redirect()->route('pre-register.verify')->with('toast', [
                'type' => 'info',
                'message' => 'Verification code sent to owner email. Please check your email and enter the code.'
            ]);
        }

        // Invalid credentials - show error
        return back()->with('toast', [
            'type' => 'error',
            'message' => 'Invalid default credentials. Please contact the administrator.'
        ])->withInput();
    }

    /**
     * Show the owner verification page.
     */
    public function showVerify(Request $request): View|RedirectResponse
    {
        // Check if pre-registration session exists
        if (!$request->session()->get('pre_registration_login')) {
            return redirect()->route('pre-register.login');
        }

        return view('pages.auth.pre-register-verify');
    }

    /**
     * Verify the owner's code.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'verification_code' => 'required|digits:6',
        ]);

        $inputCode = trim((string) $request->input('verification_code'));
        $sessionCode = (string) $request->session()->get('owner_verification_code');
        $expires = $request->session()->get('owner_verification_expires');

        // Check if code exists and hasn't expired
        if (!$sessionCode || !$expires || now()->greaterThan($expires)) {
            $request->session()->forget(['owner_verification_code', 'owner_verification_expires', 'pre_registration_login']);

            return redirect()->route('pre-register.login')->with('toast', [
                'type' => 'error',
                'message' => 'Verification code has expired. Please try again.'
            ]);
        }

        // Verify the code
        if ($inputCode !== $sessionCode) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Invalid verification code. Please try again.'
            ]);
        }

        // Clear the verification code from session and set verified flag
        $request->session()->forget(['owner_verification_code', 'owner_verification_expires']);
        $request->session()->put('pre_registration_verified', true);

        // Redirect to registration form
        return redirect()->route('register')->with('toast', [
            'type' => 'success',
            'message' => 'Verification successful! You can now complete your registration.'
        ]);
    }

    /**
     * Resend the verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        // Check if pre-registration session exists
        if (!$request->session()->get('pre_registration_login')) {
            return redirect()->route('pre-register.login');
        }

        // Generate a new 6-digit verification code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store code in session
        $request->session()->put('owner_verification_code', $code);
        $request->session()->put('owner_verification_expires', now()->addMinutes(10));

        // Get owner email
        $ownerEmail = config('app.owner_email', 'raymondtawiah23@gmail.com');

        // Log the code
        \Illuminate\Support\Facades\Log::info('Owner verification code RESENT: ' . $code);

        // Send email to owner
        try {
            Mail::send('emails.owner-verification-code', [
                'code' => $code,
                'ip' => $request->ip(),
                'time' => now()->format('Y-m-d H:i:s')
            ], function ($message) use ($ownerEmail) {
                $message->to($ownerEmail)
                    ->subject('New Registration Verification Code - GymCenter');
            });
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send owner verification email: ' . $e->getMessage());
        }

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'A new verification code has been sent to the owner email.'
        ]);
    }

    /**
     * Logout from pre-registration flow.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget([
            'pre_registration_login',
            'pre_registration_verified',
            'pre_registration_started',
            'owner_verification_code',
            'owner_verification_expires'
        ]);

        return redirect()->route('home')->with('toast', [
            'type' => 'info',
            'message' => 'You have been logged out from pre-registration.'
        ]);
    }
}
