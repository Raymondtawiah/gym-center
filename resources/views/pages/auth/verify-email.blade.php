<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Email Verification - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-green-600 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Email Verification</h2>
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">
                    Please verify your email address by clicking on the link we just emailed to you.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="bg-green-100 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-700 text-sm text-center">
                        A new verification link has been sent to the email address you provided during registration.
                    </p>
                </div>
            @endif

            <div class="space-y-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                        Resend verification email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-lg transition">
                        Log out
                    </button>
                </form>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
