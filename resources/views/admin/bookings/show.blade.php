d<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Booking #{{ $booking->id }} - GymCenter Admin</title>
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
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Back Link -->
                    <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Bookings
                    </a>

                    <!-- Booking Details -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
                        <div class="bg-green-600/20 px-6 py-4 border-b border-white/10">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-white">Booking #{{ $booking->id }}</h1>
                                @switch($booking->status)
                                    @case('confirmed')
                                        <span class="px-3 py-1 text-sm bg-green-600/20 text-green-400 rounded">Confirmed</span>
                                        @break
                                    @case('cancelled')
                                        <span class="px-3 py-1 text-sm bg-red-600/20 text-red-400 rounded">Cancelled</span>
                                        @break
                                    @case('completed')
                                        <span class="px-3 py-1 text-sm bg-blue-600/20 text-blue-400 rounded">Completed</span>
                                        @break
                                    @default
                                        <span class="px-3 py-1 text-sm bg-zinc-600/20 text-zinc-400 rounded">{{ $booking->status }}</span>
                                @endswitch
                            </div>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <!-- Member Information -->
                            <div>
                                <h2 class="text-lg font-semibold text-white mb-3">Member Information</h2>
                                @if($booking->user)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-zinc-800/50 rounded-lg p-4">
                                        <div>
                                            <span class="text-sm text-zinc-400">Name</span>
                                            <p class="text-white">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Email</span>
                                            <p class="text-white">{{ $booking->user->email }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Phone</span>
                                            <p class="text-white">{{ $booking->user->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-zinc-400">Unknown user</p>
                                @endif
                            </div>

                            <!-- Class Information (only show for class bookings) -->
                            @if($booking->gymClass)
                            <div>
                                <h2 class="text-lg font-semibold text-white mb-3">Class Information</h2>
                                @if($booking->gymClass)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-zinc-800/50 rounded-lg p-4">
                                        <div>
                                            <span class="text-sm text-zinc-400">Class Name</span>
                                            <p class="text-white">{{ $booking->gymClass->name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Instructor</span>
                                            <p class="text-white">{{ $booking->gymClass->instructor }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Day</span>
                                            <p class="text-white">{{ $booking->gymClass->day_of_week }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Time</span>
                                            <p class="text-white">{{ $booking->gymClass->start_time }} - {{ $booking->gymClass->end_time }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Room</span>
                                            <p class="text-white">{{ $booking->gymClass->room ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-zinc-400">Capacity</span>
                                            <p class="text-white">{{ $booking->gymClass->capacity }} spots</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-zinc-400">Unknown class</p>
                                @endif
                            </div>
                            @endif

                            <!-- Booking Information -->
                            <div>
                                <h2 class="text-lg font-semibold text-white mb-3">Booking Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-zinc-800/50 rounded-lg p-4">
                                    @if($booking->membership_type)
                                    <div>
                                        <span class="text-sm text-zinc-400">Membership Type</span>
                                        <p class="text-white">{{ ucfirst($booking->membership_type) }} Membership</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-zinc-400">Start Date</span>
                                        <p class="text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('l, F d, Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-zinc-400">End Date</span>
                                        <p class="text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('l, F d, Y') }}</p>
                                    </div>
                                    @if($booking->notes)
                                    <div class="md:col-span-2">
                                        <span class="text-sm text-zinc-400">Notes</span>
                                        <p class="text-white">{{ $booking->notes }}</p>
                                    </div>
                                    @endif
                                    @else
                                    <div>
                                        <span class="text-sm text-zinc-400">Booking Date</span>
                                        <p class="text-white">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F d, Y') }}</p>
                                    </div>
                                    @endif
                                    <div>
                                        <span class="text-sm text-zinc-400">Created At</span>
                                        <p class="text-white">{{ $booking->created_at->format('F d, Y g:i A') }}</p>
                                    </div>
                                    @if($booking->gym)
                                        <div>
                                            <span class="text-sm text-zinc-400">Gym</span>
                                            <p class="text-white">{{ $booking->gym->name }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Client Health Information -->
                            @if($booking->user)
                            <div>
                                <h2 class="text-lg font-semibold text-white mb-3">Client Health Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-zinc-800/50 rounded-lg p-4">
                                    @if($booking->user->weight)
                                    <div>
                                        <span class="text-sm text-zinc-400">Weight</span>
                                        <p class="text-white">{{ $booking->user->weight }} kg</p>
                                    </div>
                                    @endif
                                    @if($booking->user->height)
                                    <div>
                                        <span class="text-sm text-zinc-400">Height</span>
                                        <p class="text-white">{{ $booking->user->height }} cm</p>
                                    </div>
                                    @endif
                                    @if($booking->user->injuries !== null)
                                    <div>
                                        <span class="text-sm text-zinc-400">Has Injuries</span>
                                        <p class="text-white">{{ $booking->user->injuries ? 'Yes' : 'No' }}</p>
                                    </div>
                                    @endif
                                    @if($booking->user->injury_details)
                                    <div>
                                        <span class="text-sm text-zinc-400">Injury Details</span>
                                        <p class="text-white">{{ $booking->user->injury_details }}</p>
                                    </div>
                                    @endif
                                    @if($booking->user->health_conditions)
                                    <div class="md:col-span-2">
                                        <span class="text-sm text-zinc-400">Health Conditions</span>
                                        <p class="text-white">{{ $booking->user->health_conditions }}</p>
                                    </div>
                                    @endif
                                    @if($booking->user->allergies)
                                    <div class="md:col-span-2">
                                        <span class="text-sm text-zinc-400">Allergies</span>
                                        <p class="text-white">{{ $booking->user->allergies }}</p>
                                    </div>
                                    @endif
                                    @if($booking->user->medications)
                                    <div class="md:col-span-2">
                                        <span class="text-sm text-zinc-400">Medications</span>
                                        <p class="text-white">{{ $booking->user->medications }}</p>
                                    </div>
                                    @endif
                                    @if($booking->user->fitness_goals)
                                    <div class="md:col-span-2">
                                        <span class="text-sm text-zinc-400">Fitness Goals</span>
                                        <p class="text-white">{{ $booking->user->fitness_goals }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Actions -->
                            @if($booking->status === 'confirmed')
                                <div class="flex flex-wrap gap-3 pt-4 border-t border-white/10">
                                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-lg transition-colors">
                                            Mark as Completed
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-medium rounded-lg transition-colors">
                                            Cancel Booking
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
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
