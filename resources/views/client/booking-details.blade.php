<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Membership Details - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        <!-- Toast Notifications -->
        @include('components.toast')
        
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h <!-- Logo -->
                       -16">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-xl font-bold text-white">GymCenter</span>
                        </a>
                        
                        <!-- Desktop Navigation -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="{{ route('dashboard') }}" class="text-zinc-300 hover:text-white transition-colors">Dashboard</a>
                            <a href="{{ route('client.bookings') }}" class="text-white font-medium">My Membership</a>
                        </nav>
                        
                        <!-- Mobile Menu Button -->
                        <button id="mobile-menu-btn" class="md:hidden text-zinc-300 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <!-- User Menu -->
                        <div class="flex items-center gap-4">
                            @auth
                                <div class="flex items-center gap-3">
                                    <span class="text-zinc-300 text-sm hidden sm:block">{{ auth()->user()->name }}</span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="text-zinc-400 hover:text-white transition-colors text-sm">
                                            Log out
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Navigation Menu -->
                <div id="mobile-menu" class="hidden md:hidden bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800">
                    <div class="px-4 py-3 space-y-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-zinc-300 hover:text-white hover:bg-zinc-800 rounded-lg transition-colors">Dashboard</a>
                        <a href="{{ route('client.bookings') }}" class="block px-4 py-2 text-white font-medium bg-zinc-800 rounded-lg transition-colors">My Membership</a>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-8 px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <!-- Back Button -->
                    <a href="{{ route('client.bookings') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white mb-4 sm:mb-6 transition-colors text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Memberships
                    </a>

                    <!-- Header -->
                    <div class="mb-6 sm:mb-8">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">Membership Details</h1>
                        <p class="mt-1 sm:mt-2 text-zinc-400">View your membership and health information</p>
                    </div>

                    <!-- Business/Gym Info -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Gym Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <p class="text-zinc-400 text-sm">Business Name</p>
                                <p class="text-white font-medium text-lg">{{ $booking->gym->name ?? 'Gym' }}</p>
                            </div>
                            @if($booking->gym->address ?? false)
                            <div>
                                <p class="text-zinc-400 text-sm">Address</p>
                                <p class="text-white font-medium">{{ $booking->gym->address }}</p>
                            </div>
                            @endif
                            @if($booking->gym->phone ?? false)
                            <div>
                                <p class="text-zinc-400 text-sm">Phone</p>
                                <p class="text-white font-medium">{{ $booking->gym->phone }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Membership Details -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Membership Details</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <p class="text-zinc-400 text-sm">Membership Type</p>
                                <p class="text-white font-medium text-lg">
                                    {{ $booking->membership_type === 'monthly' ? 'Monthly' : 'Yearly' }} Membership
                                </p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Status</p>
                                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full 
                                    @if($booking->status === 'confirmed') bg-green-600/20 text-green-400
                                    @elseif($booking->status === 'pending') bg-yellow-600/20 text-yellow-400
                                    @else bg-red-600/20 text-red-400 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Start Date</p>
                                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">End Date</p>
                                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->end_date)->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Booked On</p>
                                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->created_at)->format('F d, Y') }}</p>
                            </div>
                            @if($booking->notes)
                            <div class="sm:col-span-2">
                                <p class="text-zinc-400 text-sm">Notes</p>
                                <p class="text-white font-medium">{{ $booking->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Health Information -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Health Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <p class="text-zinc-400 text-sm">Weight</p>
                                <p class="text-white font-medium">{{ $booking->user->weight ? $booking->user->weight . ' kg' : 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Height</p>
                                <p class="text-white font-medium">{{ $booking->user->height ? $booking->user->height . ' cm' : 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Health Conditions</p>
                                <p class="text-white font-medium">{{ $booking->user->health_conditions ?? 'None' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Allergies</p>
                                <p class="text-white font-medium">{{ $booking->user->allergies ?? 'None' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Current Medications</p>
                                <p class="text-white font-medium">{{ $booking->user->medications ?? 'None' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Injuries</p>
                                <p class="text-white font-medium">{{ $booking->user->injuries === 'yes' ? ($booking->user->injury_details ?? 'Yes') : 'None' }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-zinc-400 text-sm">Fitness Goals</p>
                                <p class="text-white font-medium">{{ $booking->user->fitness_goals ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <script>
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        </script>
    </body>
</html>
