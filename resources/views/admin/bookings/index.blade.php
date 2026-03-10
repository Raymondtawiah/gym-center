<x-layouts::app-main title="Class Bookings - GymCenter Admin">
    <!-- Admin Navigation -->
    <div class="bg-zinc-800/50 border-b border-zinc-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-6 py-3 overflow-x-auto">
                <a href="{{ route('admin.users.index') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Users</a>
                <a href="{{ route('admin.bookings.index') }}" class="text-white font-medium border-b-2 border-green-500 pb-1 whitespace-nowrap">Bookings</a>
                <a href="{{ route('admin.bookings.create') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">+ New Booking</a>
                <a href="{{ route('admin.bookings.print-form') }}" target="_blank" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Print Form</a>
                <a href="{{ route('admin.gym.settings') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Gym Settings</a>
                <a href="{{ route('admin.gym.staff') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Staff</a>
            </div>
        </div>
    </div>

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
            <form method="GET" class="flex flex-wrap md:flex-nowrap gap-4 items-end">
                <div class="w-full md:w-auto">
                    <label for="status" class="block text-sm font-medium text-zinc-400 mb-1">Status</label>
                    <select 
                        name="status" 
                        id="status"
                        class="w-full md:w-48 px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <label for="date" class="block text-sm font-medium text-zinc-400 mb-1">Booking Date</label>
                    <input 
                        type="date" 
                        name="date" 
                        id="date"
                        value="{{ request('date') }}"
                        class="w-full md:w-48 px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>
                <div class="w-full md:w-auto flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors whitespace-nowrap">
                        Filter
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-zinc-700 hover:bg-zinc-600 text-white font-medium rounded-lg transition-colors whitespace-nowrap text-center">
                        Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-zinc-800/50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Membership</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Booking Date</th>
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
                                @case('expired')
                                    <span class="px-2 py-1 text-xs bg-red-600/20 text-red-400 rounded">Expired</span>
                                    @break
                                @case('confirmed')
                                    @if($booking->isExpiringSoon())
                                        <span class="px-2 py-1 text-xs bg-yellow-600/20 text-yellow-400 rounded">Expiring Soon</span>
                                    @elseif($booking->isExpired())
                                        <span class="px-2 py-1 text-xs bg-red-600/20 text-red-400 rounded">Expired</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-green-600/20 text-green-400 rounded">Active</span>
                                    @endif
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
                                <!-- Renew Icon - for expired or expiring soon or confirmed memberships -->
                                @if($booking->membership_type && ($booking->status === 'expired' || $booking->isExpired() || $booking->isExpiringSoon() || $booking->status === 'confirmed'))
                                <a href="{{ route('admin.bookings.renew', $booking) }}" class="text-zinc-400 hover:text-yellow-400 transition-colors" title="Renew Membership">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </a>
                                @endif
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
</x-layouts::app-main>
