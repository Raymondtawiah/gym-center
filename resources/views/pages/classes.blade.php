<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Classes - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-xl font-bold text-white">GymCenter</span>
                        </a>
                        
                        <!-- Navigation -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="{{ route('home') }}" class="text-zinc-300 hover:text-white transition-colors">Home</a>
                            <a href="{{ route('classes') }}" class="text-green-400 font-medium">Classes</a>
                            <a href="{{ route('client.register') }}" class="text-zinc-300 hover:text-white transition-colors">Join Now</a>
                        </nav>
                        
                        <!-- Auth Buttons -->
                        <div class="flex items-center gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-zinc-300 hover:text-white transition-colors">Log in</a>
                                <a href="{{ route('client.register') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                    Join Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Page Header -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-white mb-4">Gym Classes & Schedule</h1>
                        <p class="text-zinc-400 max-w-2xl mx-auto">
                            Join our expert-led classes to achieve your fitness goals. From yoga to HIIT, we have something for everyone.
                        </p>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-600/20 border border-green-600 rounded-lg text-green-400 text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-600/20 border border-red-600 rounded-lg text-red-400 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Days of Week -->
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $classesByDay = $classes->groupBy('day_of_week');
                    @endphp

                    <div class="space-y-8">
                        @foreach($days as $day)
                            @if(isset($classesByDay[$day]) && $classesByDay[$day]->isNotEmpty())
                                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
                                    <div class="bg-green-600/20 px-6 py-4 border-b border-white/10">
                                        <h2 class="text-xl font-semibold text-white">{{ $day }}</h2>
                                    </div>
                                    <div class="divide-y divide-white/10">
                                        @foreach($classesByDay[$day] as $class)
                                            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-white/5 transition-colors">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-2">
                                                        <h3 class="text-lg font-semibold text-white">{{ $class->name }}</h3>
                                                        @if($class->room)
                                                            <span class="px-2 py-1 text-xs bg-zinc-700 text-zinc-300 rounded">{{ $class->room }}</span>
                                                        @endif
                                                    </div>
                                                    <p class="text-zinc-400 text-sm mb-2">{{ $class->description }}</p>
                                                    <div class="flex items-center gap-4 text-sm text-zinc-500">
                                                        <span class="flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ $class->start_time }} - {{ $class->end_time }}
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                            {{ $class->instructor }}
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            {{ $class->capacity }} spots
                                                        </span>
                                                    </div>
                                                </div>
                                                @auth
                                                    <div>
                                                        <form method="POST" action="{{ route('classes.book') }}" class="flex flex-col sm:flex-row gap-2 items-end">
                                                            @csrf
                                                            <input type="hidden" name="gym_class_id" value="{{ $class->id }}">
                                                            <div>
                                                                <label for="booking_date_{{ $class->id }}" class="sr-only">Select Date</label>
                                                                <input 
                                                                    type="date" 
                                                                    name="booking_date" 
                                                                    id="booking_date_{{ $class->id }}"
                                                                    class="px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                                                    min="{{ date('Y-m-d') }}"
                                                                    required
                                                                >
                                                            </div>
                                                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                                                Book Now
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div>
                                                        <a href="{{ route('client.register') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors inline-block">
                                                            Sign Up to Book
                                                        </a>
                                                    </div>
                                                @endauth
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if($classes->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-zinc-400">No classes available at the moment. Please check back later.</p>
                        </div>
                    @endif
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-zinc-900 border-t border-zinc-800 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                </div>
            </footer>
        </div>
        @fluxScripts
    </body>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</html>
