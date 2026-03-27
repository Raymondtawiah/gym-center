<x-layouts::app-main title="Clients - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Clients</h1>
                <p class="text-zinc-400 text-sm mt-1">Manage your gym members</p>
            </div>
            <a href="{{ route('client.register') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Register Client
            </a>
        </div>

        <!-- Clients Table -->
        @if($users->isEmpty())
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p class="text-zinc-400">No clients yet. Register your first client to get started.</p>
            </div>
        @else
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Membership</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Joined</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @foreach($users as $user)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-zinc-800 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-medium text-zinc-300">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">{{ $user->name }}</p>
                                                @if($user->phone)
                                                    <p class="text-xs text-zinc-500">{{ $user->phone }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                            {{ $user->membership_type ?? 'Standard' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->is_approved)
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-400">
                                                <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Approved
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-yellow-400">
                                                <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.users.show', $user) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-zinc-400 hover:text-red-400 hover:bg-zinc-800 rounded-lg transition-all" title="Delete">
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
