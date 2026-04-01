<x-layouts::app-main title="Change Membership - GymCenter">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('client.bookings.show', $booking) }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Membership Details
        </a>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Change Membership</h1>
            <p class="text-zinc-400 mt-1">Update or renew your membership type</p>
        </div>

        <!-- Current Membership Info -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Current Membership</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Type</p>
                    <p class="text-white font-medium">{{ ucfirst($booking->membership_type) }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Status</p>
                    @if($booking->isExpired())
                        <span class="inline-flex items-center gap-1.5 text-sm text-red-400 font-medium">
                            <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span> Expired
                        </span>
                    @elseif($booking->isExpiringSoon())
                        <span class="inline-flex items-center gap-1.5 text-sm text-yellow-400 font-medium">
                            <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span> Expiring Soon
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-sm text-green-400 font-medium">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Active
                        </span>
                    @endif
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Gym</p>
                    <p class="text-white font-medium">{{ $booking->gym->name ?? 'Gym' }}</p>
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
        </div>

        <!-- Change Membership Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-6">New Membership Details</h2>

                <form method="POST" action="{{ route('client.bookings.change.store', $booking) }}">
                    @csrf

                    <!-- Membership Type -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-zinc-400 mb-3">Membership Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="membership_type" value="monthly" class="peer sr-only" {{ $booking->membership_type === 'monthly' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-zinc-700 bg-zinc-800/50 peer-checked:border-green-500 peer-checked:bg-green-600/10 hover:border-zinc-600 transition-all">
                                    <p class="text-white font-medium">Monthly</p>
                                    <p class="text-zinc-400 text-sm">1 month membership</p>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="membership_type" value="yearly" class="peer sr-only" {{ $booking->membership_type === 'yearly' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-zinc-700 bg-zinc-800/50 peer-checked:border-green-500 peer-checked:bg-green-600/10 hover:border-zinc-600 transition-all">
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
                    <div class="mb-8">
                        <label for="start_date" class="block text-sm font-medium text-zinc-400 mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('client.bookings.show', $booking) }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            Change Membership
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app-main>
