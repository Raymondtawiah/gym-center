<x-layouts::app-main title="Client Management - GymCenter Admin">
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
    <!-- Register New Client Section -->
    <div class="mb-8 bg-zinc-800/50 rounded-lg border border-zinc-700 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Register New Client</h2>
                <p class="text-zinc-400 mt-1">Add a new member to your gym</p>
            </div>
            <a href="{{ route('client.register') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Open Registration Form
            </a>
        </div>
    </div>

    <!-- Clients Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white mb-4">All Clients</h2>
        
        @if($users->isEmpty())
            <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-8 text-center">
                <p class="text-zinc-400">No clients yet.</p>
            </div>
        @else
            <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-700">
                    <thead class="bg-zinc-900/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Membership</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Registered</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-zinc-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-700">
                        @foreach($users as $user)
                            <tr class="hover:bg-zinc-700/30">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                    @if($user->phone)
                                        <div class="text-sm text-zinc-400">{{ $user->phone }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zinc-300">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                                        {{ $user->membership_type ?? 'Standard' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <!-- View Icon -->
                                        <a href="{{ route('admin.users.show', $user) }}" class="text-zinc-400 hover:text-green-400 transition-colors" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts::app-main>
