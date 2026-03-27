<x-layouts::app-main title="Staff - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white">Staff Management</h1>
            <p class="text-zinc-400 text-sm mt-1">Manage your gym staff members</p>
        </div>

        <!-- Add Staff Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-zinc-800">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider">Add Staff Member</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.gym.staff.add') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-xs font-medium text-zinc-500 mb-1.5">Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="email" class="block text-xs font-medium text-zinc-500 mb-1.5">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="phone" class="block text-xs font-medium text-zinc-500 mb-1.5">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="password" class="block text-xs font-medium text-zinc-500 mb-1.5">Password</label>
                        <input type="password" name="password" id="password" required minlength="8"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            Add Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Staff List -->
        @if($staff->isEmpty())
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="text-zinc-400">No staff members yet. Add your first staff member above.</p>
            </div>
        @else
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Staff</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Added</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @foreach($staff as $member)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-purple-600/20 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-medium text-purple-400">{{ substr($member->name, 0, 1) }}</span>
                                            </div>
                                            <p class="text-sm font-medium text-white">{{ $member->name }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">{{ $member->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">{{ $member->phone ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ $member->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.users.show', $member) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.gym.staff.remove', $member) }}" class="inline" onsubmit="return confirm('Remove this staff member?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-zinc-400 hover:text-red-400 hover:bg-zinc-800 rounded-lg transition-all" title="Remove">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            </div>
        @endif
    </div>
</x-layouts::app-main>
