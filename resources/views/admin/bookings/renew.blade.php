<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Renew Membership - GymCenter Admin</title>
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
                        
                        <!-- Navigation -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="{{ route('dashboard') }}" class="text-zinc-300 hover:text-white transition-colors">Dashboard</a>
                            <a href="{{ route('admin.users.index') }}" class="text-zinc-300 hover:text-white transition-colors">Users</a>
                            <a href="{{ route('admin.bookings.index') }}" class="text-green-400 font-medium">Bookings</a>
                            <a href="{{ route('admin.bookings.create') }}" class="text-zinc-300 hover:text-white transition-colors">+ New Booking</a>
                            <a href="{{ route('admin.gym.settings') }}" class="text-zinc-300 hover:text-white transition-colors">Gym Settings</a>
                        </nav>
                        
                        <!-- User Menu -->
                        <div class="hidden md:flex items-center gap-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-zinc-300 hover:text-white transition-colors">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Back Link -->
                    <div class="mb-6">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center text-zinc-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to Booking Details
                        </a>
                    </div>

                    <!-- Page Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-white">Renew Membership</h1>
                        <p class="text-zinc-400 mt-1">Renew the membership for {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                    </div>

                    <!-- Current Membership Info -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 mb-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Current Membership Details</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-zinc-400">Member</p>
                                <p class="text-white">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400">Email</p>
                                <p class="text-white">{{ $booking->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400">Current Type</p>
                                <p class="text-white">{{ ucfirst($booking->membership_type) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400">Current Status</p>
                                @if($booking->isExpired())
                                    <span class="px-2 py-1 text-xs bg-red-600/20 text-red-400 rounded">Expired</span>
                                @elseif($booking->isExpiringSoon())
                                    <span class="px-2 py-1 text-xs bg-yellow-600/20 text-yellow-400 rounded">Expiring Soon</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-green-600/20 text-green-400 rounded">Active</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400">Current Start Date</p>
                                <p class="text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400">Current End Date</p>
                                <p class="text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Renewal Form -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Renew Membership</h2>
                        
                        <form method="POST" action="{{ route('admin.bookings.renew.store', $booking) }}">
                            @csrf
                            
                            <!-- Membership Type -->
                            <div class="mb-6">
                                <label for="membership_type" class="block text-sm font-medium text-zinc-400 mb-2">Membership Type</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="membership_type" value="monthly" class="peer sr-only" checked>
                                        <div class="p-4 rounded-lg border-2 border-zinc-700 bg-zinc-800/50 peer-checked:border-green-500 peer-checked:bg-green-600/10 hover:border-zinc-600 transition-all">
                                            <p class="text-white font-medium">Monthly</p>
                                            <p class="text-zinc-400 text-sm">1 month membership</p>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="membership_type" value="yearly" class="peer sr-only">
                                        <div class="p-4 rounded-lg border-2 border-zinc-700 bg-zinc-800/50 peer-checked:border-green-500 peer-checked:bg-green-600/10 hover:border-zinc-600 transition-all">
                                            <p class="text-white font-medium">Yearly</p>
                                            <p class="text-zinc-400 text-sm">12 month membership</p>
                                        </div>
                                    </label>
                                </div>
                                @error('membership_type')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div class="mb-6">
                                <label for="start_date" class="block text-sm font-medium text-zinc-400 mb-2">Start Date</label>
                                <input 
                                    type="date" 
                                    name="start_date" 
                                    id="start_date"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                    required
                                >
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-zinc-400 mb-2">Notes (Optional)</label>
                                <textarea 
                                    name="notes" 
                                    id="notes"
                                    rows="3"
                                    class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Add any notes about this renewal..."
                                >{{ $booking->notes }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="px-6 py-2 bg-zinc-700 hover:bg-zinc-600 text-white font-medium rounded-lg transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                    Renew Membership
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
