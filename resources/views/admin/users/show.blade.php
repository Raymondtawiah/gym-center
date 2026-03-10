<x-layouts::app-main title="Client Details - GymCenter Admin">
    <!-- Admin Navigation -->
    <div class="bg-zinc-800/50 border-b border-zinc-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-6 py-3 overflow-x-auto">
                <a href="{{ route('admin.users.index') }}" class="text-white font-medium border-b-2 border-green-500 pb-1 whitespace-nowrap">Clients</a>
                <a href="{{ route('admin.bookings.index') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Bookings</a>
                <a href="{{ route('admin.bookings.create') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">+ New Booking</a>
                <a href="{{ route('admin.gym.settings') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Gym Settings</a>
                <a href="{{ route('admin.gym.staff') }}" class="text-zinc-400 hover:text-white transition-colors whitespace-nowrap">Staff</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white mb-6 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Clients
        </a>

        <!-- Client Information -->
        <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-6 mb-6">
            <h2 class="text-2xl font-bold text-white mb-6">
                {{ $user->role === 'staff' ? 'Staff' : 'Client' }} Information
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-zinc-400 text-sm">Name</p>
                    <p class="text-white font-medium text-lg">{{ $user->name }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Email</p>
                    <p class="text-white font-medium">{{ $user->email }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Phone</p>
                    <p class="text-white font-medium">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
                
                @if($user->role !== 'staff')
                <div>
                    <p class="text-zinc-400 text-sm">Status</p>
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full 
                        @if($user->is_approved) bg-green-900 text-green-200
                        @else bg-red-900 text-red-200 @endif">
                        {{ $user->is_approved ? 'Approved' : 'Pending' }}
                    </span>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Membership Type</p>
                    <p class="text-white font-medium">{{ ucfirst($user->membership_type ?? 'Standard') }}</p>
                </div>
                @endif
                
                <div>
                    <p class="text-zinc-400 text-sm">Registered Date</p>
                    <p class="text-white font-medium">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Health Information -->
        @if($user->role === 'client')
        <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-6 mb-6">
            <h2 class="text-2xl font-bold text-white mb-6">Health Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-zinc-400 text-sm">Weight</p>
                    <p class="text-white font-medium">{{ $user->weight ? $user->weight . ' kg' : 'Not provided' }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Height</p>
                    <p class="text-white font-medium">{{ $user->height ? $user->height . ' cm' : 'Not provided' }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Health Conditions</p>
                    <p class="text-white font-medium">{{ $user->health_conditions ?? 'None' }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Allergies</p>
                    <p class="text-white font-medium">{{ $user->allergies ?? 'None' }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Current Medications</p>
                    <p class="text-white font-medium">{{ $user->medications ?? 'None' }}</p>
                </div>
                
                <div>
                    <p class="text-zinc-400 text-sm">Injuries</p>
                    <p class="text-white font-medium">{{ $user->injuries === 'yes' ? ($user->injury_details ?? 'Yes') : 'None' }}</p>
                </div>
                
                <div class="md:col-span-2">
                    <p class="text-zinc-400 text-sm">Fitness Goals</p>
                    <p class="text-white font-medium">{{ $user->fitness_goals ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="flex gap-4">
            @if(!$user->is_approved)
            <form method="POST" action="{{ route('admin.users.approve', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                    Approve {{ $user->role === 'staff' ? 'Staff' : 'Client' }}
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.users.disapprove', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white font-medium rounded-lg transition-colors">
                    Disapprove {{ $user->role === 'staff' ? 'Staff' : 'Client' }}
                </button>
            </form>
            @endif
            
            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this {{ $user->role === 'staff' ? 'staff member' : 'client' }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-medium rounded-lg transition-colors">
                    Delete {{ $user->role === 'staff' ? 'Staff' : 'Client' }}
                </button>
            </form>
        </div>
    </div>
</x-layouts::app-main>
