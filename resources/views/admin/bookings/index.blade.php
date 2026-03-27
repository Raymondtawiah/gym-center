<x-layouts::app-main title="Bookings - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Bookings</h1>
                <p class="text-zinc-400 text-sm mt-1">Manage all membership bookings</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bookings.print-form') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl border border-zinc-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Form
                </a>
                <a href="{{ route('admin.bookings.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    New Booking
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-4 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[150px]">
                    <label for="status" class="block text-xs font-medium text-zinc-500 mb-1.5">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">All Statuses</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label for="date" class="block text-xs font-medium text-zinc-500 mb-1.5">Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}"
                        class="w-full px-3 py-2 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl border border-zinc-700 transition-colors">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Bookings Table -->
        @if($bookings->isEmpty())
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <p class="text-zinc-400">No bookings found.</p>
            </div>
        @else
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Membership</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">#{{ $booking->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->user)
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-zinc-800 rounded-full flex items-center justify-center">
                                                    <span class="text-xs font-medium text-zinc-300">{{ substr($booking->user->first_name ?? '', 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-white">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                                                    <p class="text-xs text-zinc-500">{{ $booking->user->email }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-zinc-500">Unknown</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->membership_type)
                                            <div>
                                                <p class="text-sm text-white">{{ ucfirst($booking->membership_type) }}</p>
                                                <p class="text-xs text-zinc-500">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                                            </div>
                                        @else
                                            <span class="text-sm text-zinc-500">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($booking->status)
                                            @case('expired')
                                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400">
                                                    <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span> Expired
                                                </span>
                                                @break
                                            @case('confirmed')
                                                @if($booking->isExpiringSoon())
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-yellow-400">
                                                        <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span> Expiring Soon
                                                    </span>
                                                @elseif($booking->isExpired())
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400">
                                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span> Expired
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-400">
                                                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Active
                                                    </span>
                                                @endif
                                                @break
                                            @case('cancelled')
                                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400">
                                                    <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span> Cancelled
                                                </span>
                                                @break
                                            @case('completed')
                                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-400">
                                                    <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span> Completed
                                                </span>
                                                @break
                                            @default
                                                <span class="text-xs text-zinc-400">{{ $booking->status }}</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.bookings.show', $booking) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            @if($booking->membership_type && ($booking->status === 'expired' || $booking->isExpired() || $booking->isExpiringSoon() || $booking->status === 'confirmed'))
                                            <a href="{{ route('admin.bookings.renew', $booking) }}" class="p-2 text-zinc-400 hover:text-yellow-400 hover:bg-zinc-800 rounded-lg transition-all" title="Renew">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </a>
                                            @endif
                                            @if($booking->status === 'confirmed')
                                            <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="p-2 text-zinc-400 hover:text-blue-400 hover:bg-zinc-800 rounded-lg transition-all" title="Complete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                            @if(auth()->user()->isAdmin() && ($booking->status === 'confirmed' || $booking->status === 'completed'))
                                            <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-zinc-400 hover:text-red-400 hover:bg-zinc-800 rounded-lg transition-all" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-zinc-500">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($bookings->hasPages())
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layouts::app-main>
