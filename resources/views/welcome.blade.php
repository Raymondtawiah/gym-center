<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'GymCenter') }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="bg-zinc-950 text-white min-h-screen font-sans">
        @include('components.toast')

        <!-- Background -->
        <div class="fixed inset-0 z-0">
            <img
                src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                alt="Gym Background"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/90 via-zinc-950/80 to-zinc-950"></div>
        </div>

        <!-- Navbar -->
        <div class="relative z-10">
            <x-navbar />
        </div>

        <!-- Hero -->
        <div class="relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20 lg:pt-24 lg:pb-28">
                <div class="text-center max-w-3xl mx-auto">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-green-500/10 border border-green-500/20 rounded-full text-green-400 text-sm font-medium mb-6">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                        Now accepting new members
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Your Journey to <span class="text-green-400">Fitness</span><br>Starts Here
                    </h1>
                    <p class="text-lg text-zinc-400 max-w-xl mx-auto mb-10">
                        Transform your body and mind with state-of-the-art equipment, expert trainers, and a supportive community.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-8 py-3.5 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-xl transition-colors">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('client.register') }}" class="px-8 py-3.5 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-xl transition-colors">
                                Start Your Journey
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-3.5 bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white font-semibold rounded-xl transition-colors">
                                Log in
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-20">
                    <div class="bg-zinc-900/80 backdrop-blur-sm border border-zinc-800 rounded-2xl p-6 text-center">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Modern Equipment</h3>
                        <p class="text-sm text-zinc-400">State-of-the-art fitness gear to help you achieve your goals safely.</p>
                    </div>

                    <div class="bg-zinc-900/80 backdrop-blur-sm border border-zinc-800 rounded-2xl p-6 text-center">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">24/7 Access</h3>
                        <p class="text-sm text-zinc-400">Train anytime with round-the-clock facility access.</p>
                    </div>

                    <div class="bg-zinc-900/80 backdrop-blur-sm border border-zinc-800 rounded-2xl p-6 text-center">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Expert Trainers</h3>
                        <p class="text-sm text-zinc-400">Personalized guidance from certified fitness professionals.</p>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center mt-20">
                    <h2 class="text-3xl font-bold text-white mb-4">Ready to Transform?</h2>
                    <p class="text-zinc-400 mb-8 max-w-md mx-auto">Join GymCenter today and take the first step towards a healthier you.</p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3.5 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-xl transition-colors">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('client.register') }}" class="inline-block px-8 py-3.5 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-xl transition-colors">
                            Join Now
                        </a>
                    @endauth
                </div>

                <!-- Footer -->
                <footer class="mt-20 pt-8 border-t border-zinc-800/50">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-green-600 rounded flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-sm text-zinc-400">GymCenter</span>
                        </div>
                        <p class="text-xs text-zinc-500">&copy; {{ date('Y') }} GymCenter. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
