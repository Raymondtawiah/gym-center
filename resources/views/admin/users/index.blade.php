<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>User Management - GymCenter Admin</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        @include('components.toast')
        
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class justify-between h-="flex items-center16">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="text-xl font-bold text-white">GymCenter</span>
                            </a>
                            <span class="text-zinc-500">/</span>
                            <span class="text-zinc-300">User Management</span>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="text-zinc-300 hover:text-white transition-colors">
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Admin Navigation -->
            <div class="bg-zinc-800/50 border-b border-zinc-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex gap-6 py-3">
                        <a href="{{ route('admin.users.index') }}" class="text-white font-medium border-b-2 border-green-500 pb-1">Users</a>
                        <a href="{{ route('admin.bookings.index') }}" class="text-zinc-400 hover:text-white transition-colors">Bookings</a>
                        <a href="{{ route('admin.bookings.create') }}" class="text-zinc-400 hover:text-white transition-colors">+ New Booking</a>
                        <a href="{{ route('admin.gym.settings') }}" class="text-zinc-400 hover:text-white transition-colors">Gym Settings</a>
                        <a href="{{ route('admin.gym.staff') }}" class="text-zinc-400 hover:text-white transition-colors">Staff</a>
                    </div>
                </div>
            </div>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Add New Client Section -->
                <div class="mb-8 bg-zinc-800/50 rounded-lg border border-zinc-700 p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">Register New Client</h2>
                    <form method="POST" action="{{ route('client.register.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-zinc-300 mb-1">First Name *</label>
                            <input type="text" name="first_name" id="first_name" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-zinc-300 mb-1">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-300 mb-1">Email *</label>
                            <input type="email" name="email" id="email" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-zinc-300 mb-1">Phone *</label>
                            <input type="tel" name="phone" id="phone" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-zinc-300 mb-1">Date of Birth *</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="membership_type" class="block text-sm font-medium text-zinc-300 mb-1">Membership Type *</label>
                            <select name="membership_type" id="membership_type" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Select membership</option>
                                <option value="basic">Basic - Access to gym equipment</option>
                                <option value="premium">Premium - Full access + classes</option>
                                <option value="vip">VIP - Full access + personal trainer</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-zinc-300 mb-1">Address</label>
                            <input type="text" name="address" id="address" class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="emergency_contact_name" class="block text-sm font-medium text-zinc-300 mb-1">Emergency Contact Name *</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-zinc-300 mb-1">Emergency Contact Phone *</label>
                            <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-zinc-300 mb-1">Password *</label>
                            <input type="password" name="password" id="password" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-zinc-300 mb-1">Confirm Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-3 py-2 bg-zinc-900 border border-zinc-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div class="md:col-span-2 mt-4">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                Register Client
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Users Section -->
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">All Users</h2>
                    
                    @if($users->isEmpty())
                        <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-8 text-center">
                            <p class="text-zinc-400">No users yet.</p>
                        </div>
                    @else
                        <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 overflow-hidden">
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
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
        </div>

        @fluxScripts
    </body>
</html>
