<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - {{ config('app.name', 'GymCenter') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Vite CSS -->
        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-zinc-900 text-white min-h-screen font-sans">
        <!-- Background Image with Overlay -->
        <div class="fixed inset-0 z-0">
            <img 
                src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                alt="Gym Background" 
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-black/70 to-black/90"></div>
        </div>
        
        <!-- Navigation -->
        <header class="fixed top-0 left-0 right-0 w-full p-4 md:p-6 z-50">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-xl font-bold text-white">GymCenter</span>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-white hover:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                @if (Route::has('login'))
                    <nav class="hidden md:flex items-center gap-4">
                        <a href="{{ route('classes') }}" class="px-5 py-2 text-white hover:text-green-400 font-medium transition-colors">Classes</a>
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="px-5 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="px-5 py-2 text-white hover:text-green-400 font-medium transition-colors"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="px-5 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden fixed top-20 left-0 right-0 bg-zinc-900/95 backdrop-blur-sm z-40 p-4 md:hidden">
            <div class="flex flex-col gap-4">
                <a href="{{ route('classes') }}" class="px-5 py-3 text-white hover:text-green-400 font-medium transition-colors text-center">Classes</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-3 text-white hover:text-green-400 font-medium transition-colors text-center">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors text-center">Register</a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 pt-24">
            <div class="max-w-7xl mx-auto px-6 py-12 lg:py-20">
                <!-- Hero Section -->
                <div class="text-center mb-16">
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                        Your Journey to <span class="text-green-500">Fitness</span> Starts Here
                    </h1>
                    <p class="text-lg lg:text-xl text-zinc-300 max-w-2xl mx-auto mb-8">
                        Transform your body and mind with state-of-the-art equipment, expert trainers, and a supportive community that pushes you to be your best.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg transition-colors">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('client.register') }}" class="px-8 py-3 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg transition-colors">
                                Start Your Journey
                            </a>
                            <a href="{{ route('classes') }}" class="px-8 py-3 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold rounded-lg transition-colors">
                                View Class Schedule
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold rounded-lg transition-colors">
                                Log in
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-16">
                    <!-- Feature 1 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lg:p-8 border border-white/20 text-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-green-600/20 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Modern Equipment</h3>
                        <p class="text-zinc-400">State-of-the-art fitness gear and machines to help you achieve your goals efficiently and safely.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lg:p-8 border border-white/20 text-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-green-600/20 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">24/7 Access</h3>
                        <p class="text-zinc-400">Train anytime you want with our round-the-clock facility access, fitting your schedule perfectly.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lg:p-8 border border-white/20 text-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-green-600/20 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Expert Trainers</h3>
                        <p class="text-zinc-400">Get personalized fitness plans and guidance from certified trainers dedicated to your success.</p>
                    </div>
                </div>

                <!-- About Section -->
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 lg:p-12 border border-white/10 mb-16">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-white mb-4">Why Choose GymCenter?</h2>
                        <p class="text-zinc-300 max-w-2xl mx-auto">
                            At GymCenter, we believe that everyone deserves access to premium fitness facilities and expert guidance.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-zinc-300">Free personal training session</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-zinc-300">Group fitness classes included</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-zinc-300">Modern locker rooms</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-zinc-300">Nutrition counseling</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-white mb-4">Ready to Transform Your Life?</h2>
                    <p class="text-zinc-300 mb-8 max-w-xl mx-auto">
                        Join GymCenter today and take the first step towards a healthier, stronger you!
                    </p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg transition-colors">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('client.register') }}" class="inline-block px-8 py-3 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg transition-colors">
                            Join Now
                        </a>
                    @endauth
                </div>

                <!-- Footer -->
                <footer class="pt-8 border-t border-white/10">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-white font-semibold">GymCenter</span>
                        </div>
                        <p class="text-zinc-400 text-sm">
                            © <span id="year"></span> GymCenter. All rights reserved.
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
        
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</html>
