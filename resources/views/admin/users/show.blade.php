<x-layouts::app-main title="Client Details - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Clients
        </a>

        <!-- Client Header -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-green-600/20 to-emerald-600/10 px-6 py-5 border-b border-zinc-800">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center">
                            <span class="text-xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">{{ $user->name }}</h1>
                            <p class="text-sm text-zinc-400">{{ $user->role === 'staff' ? 'Staff Member' : 'Client' }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-full
                        @if($user->is_approved) bg-green-500/10 text-green-400 border border-green-500/20
                        @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 @endif">
                        <span class="w-1.5 h-1.5 rounded-full @if($user->is_approved) bg-green-400 @else bg-yellow-400 @endif"></span>
                        {{ $user->is_approved ? 'Approved' : 'Pending' }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Email</p>
                        <p class="text-white font-medium">{{ $user->email }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Phone</p>
                        <p class="text-white font-medium">{{ $user->phone ?? 'Not provided' }}</p>
                    </div>
                    @if($user->role !== 'staff')
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Membership</p>
                        <p class="text-white font-medium">{{ ucfirst($user->membership_type ?? 'Standard') }}</p>
                    </div>
                    @endif
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Registered</p>
                        <p class="text-white font-medium">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Health Information -->
        @if($user->role === 'client')
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Health Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Weight</p>
                        <p class="text-white font-medium">{{ $user->weight ? $user->weight . ' kg' : 'Not provided' }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Height</p>
                        <p class="text-white font-medium">{{ $user->height ? $user->height . ' cm' : 'Not provided' }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Injuries</p>
                        <p class="text-white font-medium">{{ $user->injuries === 'yes' ? ($user->injury_details ?? 'Yes') : 'None' }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Health Conditions</p>
                        <p class="text-white font-medium">{{ $user->health_conditions ?? 'None' }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Allergies</p>
                        <p class="text-white font-medium">{{ $user->allergies ?? 'None' }}</p>
                    </div>
                    <div class="bg-zinc-800/50 rounded-xl p-4">
                        <p class="text-xs text-zinc-500 mb-1">Medications</p>
                        <p class="text-white font-medium">{{ $user->medications ?? 'None' }}</p>
                    </div>
                    @if($user->fitness_goals)
                    <div class="bg-zinc-800/50 rounded-xl p-4 sm:col-span-2 lg:col-span-3">
                        <p class="text-xs text-zinc-500 mb-1">Fitness Goals</p>
                        <p class="text-white font-medium">{{ $user->fitness_goals }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="flex flex-wrap gap-3">
            @if(!$user->is_approved)
            <form method="POST" action="{{ route('admin.users.approve', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Approve {{ $user->role === 'staff' ? 'Staff' : 'Client' }}
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.users.disapprove', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-yellow-600 hover:bg-yellow-500 text-white text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    Disapprove
                </button>
            </form>
            @endif

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this {{ $user->role === 'staff' ? 'staff member' : 'client' }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>
</x-layouts::app-main>
