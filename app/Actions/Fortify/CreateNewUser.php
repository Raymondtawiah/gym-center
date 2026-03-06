<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $this->validate($input);

        // Every user becomes admin and creates their own gym
        $role = 'admin';

        // Create a gym for the user
        $gym = Gym::create([
            'name' => $input['gym_name'] ?? 'My Gym',
            'slug' => \Illuminate\Support\Str::slug($input['gym_name'] ?? 'my-gym'),
            'address' => $input['gym_address'] ?? null,
            'phone' => $input['gym_phone'] ?? null,
            'email' => $input['email'],
            'is_active' => true,
        ]);
        $gymId = $gym->id;

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role' => $role,
            'is_approved' => true, // All users are auto-approved
            'gym_id' => $gymId,
        ]);
        
        // Set flash message for toast notification
        Session::flash('toast', [
            'type' => 'success',
            'message' => 'Account created successfully! Please log in.'
        ]);
        
        return $user;
    }

    /**
     * Validate the input data.
     */
    protected function validate(array $input): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'gym_name' => ['required', 'string', 'max:255'],
        ];

        Validator::make($input, $rules, [
            'name.required' => 'Name is required',
            'email.required' => 'Email address is required',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'gym_name.required' => 'Gym name is required',
        ])->validate();
    }
}
