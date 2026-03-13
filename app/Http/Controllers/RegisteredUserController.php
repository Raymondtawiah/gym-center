<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    protected $creator;

    public function __construct(CreateNewUser $creator)
    {
        $this->creator = $creator;
    }

    /**
     * Handle a registration request.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Check if user has completed pre-registration verification
        if (!session()->get('pre_registration_verified')) {
            return redirect()->route('pre-register.login')->with('toast', [
                'type' => 'error',
                'message' => 'Please complete pre-registration verification first.'
            ]);
        }
        
        $user = $this->creator->create($request->all());

        // Clear the pre-registration session after successful registration
        $request->session()->forget([
            'pre_registration_login',
            'pre_registration_verified',
            'pre_registration_started'
        ]);

        // Redirect to login with toast message
        return redirect()->route('login')->with('toast', [
            'type' => 'success',
            'message' => 'Account created successfully! Please log in.'
        ]);
    }
}
