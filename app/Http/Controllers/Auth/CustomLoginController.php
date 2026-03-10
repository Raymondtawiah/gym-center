<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class CustomLoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $credentials = $request->validate([
            Fortify::username() => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is approved
            if (!$user->isApproved()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                throw \Illuminate\Validation\ValidationException::withMessages([
                    Fortify::username() => 'Your account is pending approval. Please contact the administrator.',
                ]);
            }
            
            // Generate and send verification code to all users
            $gymName = 'GymCenter';
            if ($user->gym) {
                $gymName = $user->gym->name;
            }
            
            // Generate 6-digit code
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store in session
            $request->session()->put('verification_code', $code);
            $request->session()->put('verification_code_expires', now()->addMinutes(10));
            $request->session()->put('verification_user_id', $user->id);
            $request->session()->put('require_verification', true);
            
            // Log the code
            \Illuminate\Support\Facades\Log::info('Verification code generated: ' . $code . ' for user: ' . $user->email);
            
            // Send notification
            $user->notify(new \App\Notifications\LoginVerificationNotification($gymName, $code));
            
            // Redirect to verification page
            return redirect()->route('login.verify');
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            Fortify::username() => 'The provided credentials do not match our records.',
        ]);
    }
}
