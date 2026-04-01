<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Forgot Password - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Forgot Password</h2>
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">
                    Enter your email address and we'll send you a verification code to reset your password.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.email.post') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <input 
                        type="email" 
                        name="email"
                        required
                        autofocus
                        placeholder="Email address" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 {{ $errors->has('email') ? 'border-red-500' : '' }}"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Send Verification Code
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center mt-6">
                <span class="text-gray-600 text-sm">Remember your password? </span>
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-600 text-sm font-medium">
                    Log in
                </a>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
