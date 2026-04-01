<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>Log in - {{ config('app.name', 'Laravel') }}</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">
        <!-- Toast Notifications -->
        @include('components.toast')

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl flex overflow-hidden">
            
            <!-- Left Side -->
            <div class="w-1/2 bg-green-600 text-white p-10 hidden md:flex flex-col justify-center">
                <h2 class="text-3xl font-bold mb-4">Welcome Back!</h2>
                <p class="mb-6">Login to continue your journey with us.</p>
                <a href="{{ route('login') }}" class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-green-600 transition inline-block text-center">Login</a>
                
                <h2 class="text-3xl font-bold mt-10 mb-4">New Here?</h2>
                <p class="mb-6">Create an account and get started.</p>
                <a href="{{ route('register') }}" class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-green-600 transition inline-block text-center">Sign Up</a>
            </div>

            <!-- Right Side -->
            <div class="w-full md:w-1/2 p-10">
                <!-- Login Form -->
                <div id="loginForm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Login</h2>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <input 
                                type="email" 
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
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

                        <!-- Password Input -->
                        <div class="mb-4">
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
                                    <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    name="remember"
                                    id="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="mr-2"
                                />
                                <span class="text-gray-700">Remember me</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                            Login
                        </button>

                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <div class="mt-4 text-center">
                                <a href="{{ route('password.request') }}" class="text-green-600 hover:text-green-500 text-sm">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif
                    </form>

                    <!-- Sign Up Link for Mobile -->
                    <div class="mt-6 text-center md:hidden">
                        <span class="text-gray-600">New to GymCenter? </span>
                        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-500 font-medium">
                            Create an account
                        </a>
                    </div>
                </div>
            </div>
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
