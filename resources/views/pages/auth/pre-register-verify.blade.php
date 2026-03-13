<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <title>Owner Verification - GymCenter</title>
</head>
<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <div class="flex flex-col items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md">
            <!-- Logo and Company Name -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">GymCenter</h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Owner Authorization Required</p>
            </div>

            <!-- Verification Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl border border-zinc-200 dark:border-zinc-700 p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-2">Enter Verification Code</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                        A 6-digit verification code has been sent to the owner's email. Enter it below to authorize the registration.
                    </p>
                </div>

                <!-- Toast Messages -->
                @include('components.toast')

                <!-- Verification Code Form -->
                <form method="POST" action="{{ route('pre-register.verify.code') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="verification_code" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2 text-center">
                            6-Digit Verification Code
                        </label>
                        <input 
                            type="text" 
                            name="verification_code" 
                            id="verification_code"
                            maxlength="6"
                            pattern="\d{6}"
                            class="w-full px-4 py-3 text-center text-2xl font-mono tracking-widest border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="000000"
                            required
                            autofocus
                        >
                        @error('verification_code')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                        Verify & Continue to Registration
                    </button>
                </form>

                <!-- Resend Button -->
                <form method="POST" action="{{ route('pre-register.verify.resend') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 text-zinc-700 dark:text-zinc-300 font-medium rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Resend Code
                    </button>
                </form>

                <!-- Cancel Button -->
                <form method="POST" action="{{ route('pre-register.logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 font-medium rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Cancel
                    </button>
                </form>
            </div>

            <!-- Help Text -->
            <p class="text-center text-zinc-500 dark:text-zinc-400 text-sm mt-6">
                Code expires in 10 minutes. Having trouble? Contact the administrator.
            </p>
        </div>
    </div>
</body>
</html>
