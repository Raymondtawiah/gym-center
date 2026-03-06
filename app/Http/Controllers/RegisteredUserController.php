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
        $user = $this->creator->create($request->all());

        // Redirect to login with toast message
        return redirect()->route('login')->with('toast', [
            'type' => 'success',
            'message' => 'Account created successfully! Please log in.'
        ]);
    }
}
