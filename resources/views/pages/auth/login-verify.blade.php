<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <title>Verify Your Login - GymCenter</title>
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
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $gymName }}</h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Verify Your Login</p>
            </div>

            <!-- Verification Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl border border-zinc-200 dark:border-zinc-700 p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-2">Enter Verification Code</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                        We've sent a 6-digit verification code to your email. Enter it below to verify your login.
                    </p>
                </div>

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                        <p class="text-red-700 dark:text-red-400 text-sm text-center">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('status') === 'verification-code-sent')
                    <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                        <p class="text-green-700 dark:text-green-400 text-sm text-center">
                            A new verification code has been sent to your email.
                        </p>
                    </div>
                @endif

                <!-- Verification Code Form -->
                <form method="POST" action="{{ route('login.verify.code') }}">
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
                        Verify & Login
                    </button>
                </form>

                <!-- Resend Button -->
                <form method="POST" action="{{ route('login.verify.resend') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 text-zinc-700 dark:text-zinc-300 font-medium rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Resend Code
                    </button>
                </form>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 font-medium rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Help Text -->
            <p class="text-center text-zinc-500 dark:text-zinc-400 text-sm mt-6">
                Code expires in 10 minutes. Having trouble? Contact your administrator.
            </p>
        </div>
    </div>
</body>
</html>
