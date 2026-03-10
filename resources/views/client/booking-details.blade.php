<x-layouts::app-main title="Membership Details - GymCenter">
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
</x-layouts::app-main>
