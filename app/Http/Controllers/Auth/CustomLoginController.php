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
            
            // Redirect to verification page (code will be generated there)
            return redirect()->route('login.verify');
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            Fortify::username() => 'The provided credentials do not match our records.',
        ]);
    }
}
