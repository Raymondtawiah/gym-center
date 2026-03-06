<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Class Bookings - GymCenter Admin</title>
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
                            <a href="{{ route('admin.bookings.print-form') }}" target="_blank" class="text-zinc-300 hover:text-white transition-colors">Print Form</a>
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
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Page Header -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-white">Class Bookings</h1>
                            <p class="text-zinc-400 mt-1">Manage all class bookings</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.bookings.print-form') }}" target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-lg transition-colors">
                                Print Form
                            </a>
                            <a href="{{ route('admin.bookings.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                + Create Booking
                            </a>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 mb-6">
                        <form method="GET" class="flex flex-wrap gap-4 items-end">
                            <div>
                                <label for="status" class="block text-sm font-medium text-zinc-400 mb-1">Status</label>
                                <select 
                                    name="status" 
                                    id="status"
                                    class="px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <option value="">All Statuses</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-zinc-400 mb-1">Booking Date</label>
                                <input 
                                    type="date" 
                                    name="date" 
                                    id="date"
                                    value="{{ request('date') }}"
                                    class="px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                            </div>
                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                Filter
                            </button>
                            <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-zinc-700 hover:bg-zinc-600 text-white font-medium rounded-lg transition-colors">
                                Clear
                            </a>
                        </form>
                    </div>

                    <!-- Bookings Table -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-zinc-800/50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Member</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Membership</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse($bookings as $booking)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">
                                            #{{ $booking->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($booking->user)
                                                <div class="text-sm text-white">
                                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                                </div>
                                                <div class="text-sm text-zinc-500">
                                                    {{ $booking->user->email }}
                                                </div>
                                            @else
                                                <span class="text-zinc-500">Unknown User</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($booking->membership_type)
                                                <div class="text-sm text-white">
                                                    {{ ucfirst($booking->membership_type) }} Membership
                                                </div>
                                                <div class="text-sm text-zinc-500">
                                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                                </div>
                                            @elseif($booking->gymClass)
                                                <div class="text-sm text-white">
                                                    {{ $booking->gymClass->name }}
                                                </div>
                                                <div class="text-sm text-zinc-500">
                                                    {{ $booking->gymClass->day_of_week }} {{ $booking->gymClass->start_time }}
                                                </div>
                                            @else
                                                <span class="text-zinc-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @switch($booking->status)
                                                @case('confirmed')
                                                    <span class="px-2 py-1 text-xs bg-green-600/20 text-green-400 rounded">Confirmed</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="px-2 py-1 text-xs bg-red-600/20 text-red-400 rounded">Cancelled</span>
                                                    @break
                                                @case('completed')
                                                    <span class="px-2 py-1 text-xs bg-blue-600/20 text-blue-400 rounded">Completed</span>
                                                    @break
                                                @default
                                                    <span class="px-2 py-1 text-xs bg-zinc-600/20 text-zinc-400 rounded">{{ $booking->status }}</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center gap-3">
                                                <!-- View Icon -->
                                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-zinc-400 hover:text-green-400 transition-colors" title="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                @if($booking->status === 'confirmed')
                                                    <!-- Complete Icon -->
                                                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit" class="text-zinc-400 hover:text-blue-400 transition-colors" title="Mark as Completed">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <!-- Cancel/Delete Icon - Admin Only -->
                                                    @if(auth()->user()->isAdmin())
                                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-zinc-400 hover:text-red-400 transition-colors" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    @endif
                                                @endif
                                                @if($booking->status === 'completed')
                                                    <!-- Delete Icon for completed bookings - Admin Only -->
                                                    @if(auth()->user()->isAdmin())
                                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-zinc-400 hover:text-red-400 transition-colors" title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-zinc-400">
                                            No bookings found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($bookings->hasPages())
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-zinc-900 border-t border-zinc-800 py-8 mt-12">
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
