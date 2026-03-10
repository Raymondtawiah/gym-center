<x-layouts::app-main title="Staff Management - GymCenter Admin">
    <!-- Admin Navigation -->
    <div class="bg-zinc-800/50 border-b border-zinc-700 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-6 py-3">
                <a href="{{ route('admin.users.index') }}" class="text-zinc-400 hover:text-white transition-colors">Client</a>
                <a href="{{ route('admin.bookings.index') }}" class="text-zinc-400 hover:text-white transition-colors">Bookings</a>
                <a href="{{ route('admin.bookings.create') }}" class="text-zinc-400 hover:text-white transition-colors">+ New Booking</a>
                <a href="{{ route('admin.gym.settings') }}" class="text-zinc-400 hover:text-white transition-colors">Gym Settings</a>
                <a href="{{ route('admin.gym.staff') }}" class="text-white font-medium border-b-2 border-green-500 pb-1">Staff</a>
            </div>
        </div>
    </div>

    <!-- Add Staff Form -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-4">Add Staff Member</h2>
        
        <form method="POST" action="{{ route('admin.gym.staff.add') }}" class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Name</label>
                    <input type="text" name="name" id="name" required 
                        class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" required 
                        class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-zinc-300 mb-2">Phone</label>
                    <input type="text" name="phone" id="phone" 
                        class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required minlength="8" 
                            class="w-full px-4 py-2 pr-8 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder-zinc-500">
                        <button type="button" onclick="togglePassword('password')" class="absolute right-0 top-0 bottom-0 pr-2 flex items-center" tabindex="-1">
                            <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400 hover:text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="password-eye-off" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400 hover:text-zinc-300 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                        Add Staff
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Staff List -->
    <div>
        <h2 class="text-2xl font-bold text-white mb-4">Staff Members</h2>
        
        @if($staff->isEmpty())
            <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-8 text-center">
                <p class="text-zinc-400">No staff members yet. Add your first staff member above.</p>
            </div>
        @else
            <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-700">
                    <thead class="bg-zinc-900/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase tracking-wider">Added</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-zinc-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-700">
                        @foreach($staff as $member)
                            <tr class="hover:bg-zinc-700/30">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $member->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zinc-300">{{ $member->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zinc-300">{{ $member->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                        Staff
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">
                                    {{ $member->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <!-- View Icon -->
                                        <a href="{{ route('admin.users.show', $member) }}" class="text-zinc-400 hover:text-green-400 transition-colors" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <!-- Remove -->
                                        <form method="POST" action="{{ route('admin.gym.staff.remove', $member) }}" class="inline" onsubmit="return confirm('Are you sure you want to remove this staff member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300" title="Remove">
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

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(inputId + '-eye');
    const eyeOff = document.getElementById(inputId + '-eye-off');
    
    if (input.type === 'password') {
        input.type = 'text';
        eye.classList.add('hidden');
        eyeOff.classList.remove('hidden');
    } else {
        input.type = 'password';
        eye.classList.remove('hidden');
        eyeOff.classList.add('hidden');
    }
}
</script>
