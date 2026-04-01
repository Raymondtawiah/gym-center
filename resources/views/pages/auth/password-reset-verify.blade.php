<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Verify Password Reset - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Verify Password Reset</h2>
            <p class="text-gray-600 text-center mb-6">Enter the 6-digit code sent to your email</p>
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">
                    We've sent a verification code to your email. Enter it below to continue.
                </p>
            </div>

            <!-- Error Message -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-200 rounded-lg p-4 mb-6">
                    <p class="text-red-700 text-sm text-center">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('status') === 'verification-code-sent')
                <div class="bg-green-100 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-700 text-sm text-center">
                        A new verification code has been sent to your email.
                    </p>
                </div>
            @endif

            <!-- Verification Code Form -->
            <form method="POST" action="{{ route('password.reset.verify.code') }}">
                @csrf
                
                <!-- Hidden Email Field -->
                <input type="hidden" name="email" value="{{ session('password_reset_email') ?? old('email') }}">
                
                <div class="mb-6">
                    <label for="verification_code" class="block text-sm font-medium text-gray-700 mb-2 text-center">
                        6-Digit Verification Code
                    </label>
                    <input 
                        type="text" 
                        name="verification_code" 
                        id="verification_code"
                        maxlength="6"
                        pattern="\d{6}"
                        class="w-full px-4 py-3 text-center text-2xl font-mono tracking-widest border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="000000"
                        required
                        autofocus
                    >
                    @error('verification_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Verify Code
                </button>
            </form>

            <!-- Resend Button -->
            <form method="POST" action="{{ route('password.reset.resend') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Resend Code
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-600 text-sm font-medium">
                    Back to Login
                </a>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
