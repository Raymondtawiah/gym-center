<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>My Memberships - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        <!-- Toast Notifications -->
        @include('components.toast')
        
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
                <div class="max-w-7xl mx-auto">
                    <!-- Header -->
                    <div class="mb-6 sm:mb-8">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">My Memberships</h1>
                        <p class="mt-1 sm:mt-2 text-zinc-400">View your active and past memberships</p>
                    </div>

                    <!-- User Info Card -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 sm:mb-8">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Your Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                            <div>
                                <p class="text-zinc-400 text-sm">Name</p>
                                <p class="text-white font-medium">{{ $user->first_name }} {{ $user->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Email</p>
                                <p class="text-white font-medium text-sm sm:text-base break-all">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Phone</p>
                                <p class="text-white font-medium">{{ $user->phone ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-sm">Membership Type</p>
                                <p class="text-white font-medium">{{ ucfirst($user->membership_type ?? 'No active membership') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 sm:mb-8">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Filter Memberships</h2>
                        <form method="GET" action="{{ route('client.bookings') }}" class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label for="type" class="block text-sm text-zinc-400 mb-1">Membership Type</label>
                                    <select name="type" id="type" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 sm:px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-green-500 text-sm sm:text-base">
                                        <option value="">All Types</option>
                                        <option value="monthly" {{ request('type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="yearly" {{ request('type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm text-zinc-400 mb-1">Status</label>
                                    <select name="status" id="status" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 sm:px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-green-500 text-sm sm:text-base">
                                        <option value="">All Statuses</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Active</option>
                                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="year" class="block text-sm text-zinc-400 mb-1">Year</label>
                                    <select name="year" id="year" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 sm:px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-green-500 text-sm sm:text-base">
                                        <option value="">All Years</option>
                                        @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-medium px-4 py-2 rounded-lg transition-colors text-sm sm:text-base">
                                        Filter
                                    </button>
                                </div>
                            </div>
                            @if(request()->hasAny(['type', 'status', 'year']))
                                <div class="pt-2">
                                    <a href="{{ route('client.bookings') }}" class="text-zinc-400 hover:text-white transition-colors text-sm">
                                        Clear Filters
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>

                    <!-- Memberships List -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
                        <div class="p-4 sm:p-6 border-b border-white/10">
                            <h2 class="text-lg sm:text-xl font-semibold text-white">Membership History ({{ $bookings->total() }})</h2>
                        </div>
                        
                        @if($bookings->count() > 0)
                            <div class="divide-y divide-white/10">
                                @foreach($bookings as $booking)
                                    <div class="p-4 sm:p-6">
                                        <div class="flex flex-col gap-4">
                                            <!-- Top Row: Status and Actions -->
                                            <div class="flex flex-wrap items-center justify-between gap-3">
                                                <div class="flex items-center gap-2 sm:gap-3">
                                                    <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm font-medium rounded-full 
                                                        @if($booking->status === 'expired' || $booking->isExpired()) bg-red-600/20 text-red-400
                                                        @elseif($booking->isExpiringSoon()) bg-yellow-600/20 text-yellow-400
                                                        @elseif($booking->status === 'confirmed') bg-green-600/20 text-green-400
                                                        @elseif($booking->status === 'pending') bg-yellow-600/20 text-yellow-400
                                                        @else bg-red-600/20 text-red-400 @endif">
                                                        @if($booking->isExpired() || $booking->status === 'expired') Expired
                                                        @elseif($booking->isExpiringSoon()) Expiring Soon
                                                        @else {{ ucfirst($booking->status) }}
                                                        @endif
                                                    </span>
                                                    <span class="text-zinc-400 text-xs sm:text-sm">
                                                        {{ $booking->membership_type === 'monthly' ? 'Monthly' : 'Yearly' }} Membership
                                                    </span>
                                                </div>
                                                <a href="{{ route('client.bookings.show', $booking->id) }}" class="bg-green-600 hover:bg-green-500 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center gap-2 text-xs sm:text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </a>
                                            </div>
                                            
                                            <!-- Middle Row: Gym Name -->
                                            <div>
                                                <p class="text-white font-medium text-base sm:text-lg">
                                                    {{ $booking->gym->name ?? 'Gym' }}
                                                </p>
                                            </div>
                                            
                                            <!-- Bottom Row: Dates and Booked On -->
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs sm:text-sm text-zinc-400">
                                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                                                    <span>Start: {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                                                    <span>End: {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-xs">Booked: {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="p-4 sm:p-6 border-t border-white/10 overflow-x-auto">
                                <div class="min-w-max">
                                    {{ $bookings->appends(request()->query())->links() }}
                                </div>
                            </div>
                        @else
                            <div class="p-8 sm:p-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-zinc-400 text-base sm:text-lg">No memberships found</p>
                                <p class="text-zinc-500 text-sm mt-1">Contact the gym to get your membership started</p>
                            </div>
                        @endif
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
