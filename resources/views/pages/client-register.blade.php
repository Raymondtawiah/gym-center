<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php use Illuminate\Support\Facades\Session; @endphp
        <title>{{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Client Registration' }} - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        <!-- Toast Notifications -->
        @include('components.toast')
        
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-2xl flex-col gap-6">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                    <span class="text-xl font-bold text-white">GymCenter</span>
                </a>

                <div class="flex flex-col gap-6">
                    <!-- Back Link -->
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 text-zinc-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Admin
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="flex items-center gap-2 text-zinc-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Home
                        </a>
                    @endif
                    
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">
                            <div class="flex flex-col gap-6">
                                <x-auth-header 
                                    :title="__(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register New Client' : 'Join GymCenter')" 
                                    :description="__(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Add a new member to your gym' : 'Register as a new gym member to start your fitness journey')" 
                                />

                                <!-- Session Status -->
                                <x-auth-session-status class="text-center" :status="session('status')" />

                                <form method="POST" action="{{ route('client.register.store') }}" class="flex flex-col gap-6">
                                    @csrf
                                    @csrf
                                    
                                    <!-- Personal Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- First Name -->
                                        <flux:input
                                            name="first_name"
                                            :label="__('First Name')"
                                            :value="old('first_name')"
                                            type="text"
                                            required
                                            autofocus
                                            autocomplete="given-name"
                                            :placeholder="__('First name')"
                                        />

                                        <!-- Last Name -->
                                        <flux:input
                                            name="last_name"
                                            :label="__('Last Name')"
                                            :value="old('last_name')"
                                            type="text"
                                            required
                                            autocomplete="family-name"
                                            :placeholder="__('Last name')"
                                        />
                                    </div>

                                    <!-- Email Address -->
                                    <flux:input
                                        name="email"
                                        :label="__('Email address')"
                                        :value="old('email')"
                                        type="email"
                                        required
                                        autocomplete="email"
                                        placeholder="email@example.com"
                                    />

                                    <!-- Phone Number -->
                                    <flux:input
                                        name="phone"
                                        :label="__('Phone Number')"
                                        :value="old('phone')"
                                        type="tel"
                                        required
                                        autocomplete="tel"
                                        :placeholder="__('Phone number')"
                                    />

                                    <!-- Date of Birth -->
                                    <flux:input
                                        name="date_of_birth"
                                        :label="__('Date of Birth')"
                                        :value="old('date_of_birth')"
                                        type="date"
                                        required
                                    />

                                    <!-- Address -->
                                    <flux:input
                                        name="address"
                                        :label="__('Address')"
                                        :value="old('address')"
                                        type="text"
                                        autocomplete="street-address"
                                        :placeholder="__('Full address')"
                                    />

                                    <!-- Emergency Contact -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <flux:input
                                            name="emergency_contact_name"
                                            :label="__('Emergency Contact Name')"
                                            :value="old('emergency_contact_name')"
                                            type="text"
                                            required
                                            :placeholder="__('Contact name')"
                                        />

                                        <flux:input
                                            name="emergency_contact_phone"
                                            :label="__('Emergency Contact Phone')"
                                            :value="old('emergency_contact_phone')"
                                            type="tel"
                                            required
                                            :placeholder="__('Contact phone')"
                                        />
                                    </div>

                                    <!-- Membership Type -->
                                    <div>
                                        <label for="membership_type" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                            {{ __('Membership Type') }}
                                        </label>
                                        <select 
                                            name="membership_type" 
                                            id="membership_type"
                                            class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-green-500"
                                            required
                                        >
                                            <option value="">Select membership type</option>
                                            <option value="basic">Basic - Access to gym equipment</option>
                                            <option value="premium">Premium - Full access + classes</option>
                                            <option value="vip">VIP - Full access + personal trainer</option>
                                        </select>
                                    </div>

                                    <!-- Password -->
                                    <flux:input
                                        name="password"
                                        :label="__('Password')"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        :placeholder="__('Password')"
                                        viewable
                                    />

                                    <!-- Confirm Password -->
                                    <flux:input
                                        name="password_confirmation"
                                        :label="__('Confirm password')"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        :placeholder="__('Confirm password')"
                                        viewable
                                    />

                                    <!-- Terms -->
                                    <div class="flex items-start gap-3">
                                        <input 
                                            type="checkbox" 
                                            name="terms" 
                                            id="terms" 
                                            required
                                            class="mt-1 w-4 h-4 text-green-600 border-zinc-300 rounded focus:ring-green-500"
                                        >
                                        <label for="terms" class="text-sm text-zinc-600 dark:text-zinc-400">
                                            I agree to the <a href="{{ route('terms') }}" class="text-green-600 hover:underline">Terms and Conditions</a> and <a href="{{ route('privacy') }}" class="text-green-600 hover:underline">Privacy Policy</a>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <flux:button type="submit" variant="primary" class="w-full" data-test="register-client-button">
                                            {{ __(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Register as Member') }}
                                        </flux:button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
