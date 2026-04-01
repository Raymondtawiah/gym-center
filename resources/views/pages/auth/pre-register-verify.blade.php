<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Owner Verification - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-green-600 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Owner Verification</h2>
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">
                    A 6-digit verification code has been sent to the owner's email. Enter it below to authorize the registration.
                </p>
            </div>

            <!-- Verification Code Form -->
            <form method="POST" action="{{ route('pre-register.verify.code') }}">
                @csrf
                
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
                    Verify & Continue to Registration
                </button>
            </form>

            <!-- Resend Button -->
            <form method="POST" action="{{ route('pre-register.verify.resend') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Resend Code
                </button>
            </form>

            <!-- Cancel Button -->
            <form method="POST" action="{{ route('pre-register.logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-gray-500 hover:text-green-500 font-medium rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cancel
                </button>
            </form>

            <!-- Help Text -->
            <p class="text-center text-gray-500 text-sm mt-6">
                Code expires in 10 minutes. Having trouble? Contact the administrator.
            </p>
        </div>

        @fluxScripts
    </body>
</html>
