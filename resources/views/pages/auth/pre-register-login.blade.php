<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Pre-Register - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Pre-Register</h2>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <!-- Authorization Notice -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-green-900 mb-1">Authorization Required</h3>
                        <p class="text-xs text-green-700 leading-relaxed">
                            To register a new gym, you need authorization. Please log in with the default credentials provided. A verification code will be sent to the owner for approval.
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('pre-register.login') }}">
                @csrf

                <!-- Default Email -->
                <div class="mb-4">
                    <input 
                        type="email" 
                        name="email"
                        id="email"
                        value="admin@gymcenter.com"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Email" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 {{ $errors->has('email') ? 'border-red-500' : '' }}"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Default Password -->
                <div class="mb-6">
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password" 
                            class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 {{ $errors->has('password') ? 'border-red-500' : '' }}"
                        />
                        <button type="button" class="absolute right-0 top-0 h-full px-3 flex items-center" onclick="togglePassword('password')">
                            <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Continue to Verification
                </button>
            </form>

            <!-- Back to Home -->
            <p class="text-center text-gray-600 mt-4">
                Need help?
                <a href="{{ route('home') }}" class="text-green-600 font-semibold hover:underline">Back to Home</a>
            </p>
        </div>

        @fluxScripts

        <script>
            function togglePassword(inputId) {
                const input = document.getElementById(inputId);
                const eye = document.getElementById(inputId + '-eye');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                } else {
                    input.type = 'password';
                    eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            }
        </script>
    </body>
</html>
