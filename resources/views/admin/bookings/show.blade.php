<x-layouts::app-main title="Booking #{{ $booking->id }} - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Bookings
        </a>

        <!-- Booking Header -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-green-600/20 to-emerald-600/10 px-6 py-5 border-b border-zinc-800">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Booking #{{ $booking->id }}</h1>
                        <p class="text-sm text-zinc-400 mt-1">Created {{ $booking->created_at->format('F d, Y g:i A') }}</p>
                    </div>
                    @switch($booking->status)
                        @case('confirmed')
                            @if($booking->isExpiringSoon())
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span>
                                    Expiring Soon
                                </span>
                            @elseif($booking->isExpired())
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-400 border border-red-500/20 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                    Expired
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/20 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                                    Active
                                </span>
                            @endif
                            @break
                        @case('cancelled')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-400 border border-red-500/20 rounded-full">
                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                Cancelled
                            </span>
                            @break
                        @case('completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full">
                                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span>
                                Completed
                            </span>
                            @break
                        @default
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-zinc-500/10 text-zinc-400 border border-zinc-500/20 rounded-full">
                                {{ $booking->status }}
                            </span>
                    @endswitch
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Member Information -->
                <div>
                    <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-3">Member Information</h2>
                    @if($booking->user)
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-zinc-800/50 rounded-xl p-4">
                                <p class="text-xs text-zinc-500 mb-1">Name</p>
                                <p class="text-white font-medium">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                            </div>
                            <div class="bg-zinc-800/50 rounded-xl p-4">
                                <p class="text-xs text-zinc-500 mb-1">Email</p>
                                <p class="text-white font-medium">{{ $booking->user->email }}</p>
                            </div>
                            <div class="bg-zinc-800/50 rounded-xl p-4">
                                <p class="text-xs text-zinc-500 mb-1">Phone</p>
                                <p class="text-white font-medium">{{ $booking->user->phone ?? 'N/A' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-zinc-500">Unknown user</p>
                    @endif
                </div>

                <!-- Membership Information -->
                @if($booking->membership_type)
                <div>
                    <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-3">Membership Details</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Type</p>
                            <p class="text-white font-medium">{{ ucfirst($booking->membership_type) }} Membership</p>
                        </div>
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Start Date</p>
                            <p class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                        </div>
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">End Date</p>
                            <p class="text-white font-medium">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @if($booking->notes)
                        <div class="mt-4 bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Notes</p>
                            <p class="text-white">{{ $booking->notes }}</p>
                        </div>
                    @endif
                </div>
                @endif

                <!-- Health Information -->
                @if($booking->user)
                <div>
                    <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-3">Health Information</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @if($booking->user->weight)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Weight</p>
                            <p class="text-white font-medium">{{ $booking->user->weight }} kg</p>
                        </div>
                        @endif
                        @if($booking->user->height)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Height</p>
                            <p class="text-white font-medium">{{ $booking->user->height }} cm</p>
                        </div>
                        @endif
                        @if($booking->user->injuries !== null)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Has Injuries</p>
                            <p class="text-white font-medium">{{ $booking->user->injuries ? 'Yes' : 'No' }}</p>
                        </div>
                        @endif
                        @if($booking->user->health_conditions)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Health Conditions</p>
                            <p class="text-white font-medium">{{ $booking->user->health_conditions }}</p>
                        </div>
                        @endif
                        @if($booking->user->allergies)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Allergies</p>
                            <p class="text-white font-medium">{{ $booking->user->allergies }}</p>
                        </div>
                        @endif
                        @if($booking->user->medications)
                        <div class="bg-zinc-800/50 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 mb-1">Medications</p>
                            <p class="text-white font-medium">{{ $booking->user->medications }}</p>
                        </div>
                        @endif
                        @if($booking->user->fitness_goals)
                        <div class="bg-zinc-800/50 rounded-xl p-4 sm:col-span-2">
                            <p class="text-xs text-zinc-500 mb-1">Fitness Goals</p>
                            <p class="text-white font-medium">{{ $booking->user->fitness_goals }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-zinc-800">
                    @if($booking->membership_type && ($booking->status === 'expired' || $booking->isExpired() || $booking->isExpiringSoon() || $booking->status === 'confirmed'))
                        <a href="{{ route('admin.bookings.renew', $booking) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Renew Membership
                        </a>
                    @endif
                    @if($booking->status === 'confirmed')
                        <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Mark Completed
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 3 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts::app-main>
