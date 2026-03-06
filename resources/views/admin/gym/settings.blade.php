<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Gym Settings - GymCenter Admin</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        @include('components.toast')
        
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="text-xl font-bold text-white">GymCenter</span>
                            </a>
                            <span class="text-zinc-500">/</span>
                            <span class="text-zinc-300">Gym Settings</span>
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
                        <a href="{{ route('admin.users.index') }}" class="text-zinc-400 hover:text-white transition-colors">Users</a>
                        <a href="{{ route('admin.bookings.index') }}" class="text-zinc-400 hover:text-white transition-colors">Bookings</a>
                        <a href="{{ route('admin.bookings.create') }}" class="text-zinc-400 hover:text-white transition-colors">+ New Booking</a>
                        <a href="{{ route('admin.gym.settings') }}" class="text-white font-medium border-b-2 border-green-500 pb-1">Gym Settings</a>
                        <a href="{{ route('admin.gym.staff') }}" class="text-zinc-400 hover:text-white transition-colors">Staff</a>
                    </div>
                </div>
            </div>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Gym Settings Form -->
                <div class="max-w-2xl">
                    <h2 class="text-2xl font-bold text-white mb-6">Gym Settings</h2>
                    
                    <form method="POST" action="{{ route('admin.gym.update', $gym) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        
                        <div class="bg-zinc-800/50 rounded-lg border border-zinc-700 p-6 space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Gym Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $gym->name) }}" 
                                    class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="slug" class="block text-sm font-medium text-zinc-300 mb-2">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $gym->slug) }}" 
                                    class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $gym->email) }}" 
                                    class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-zinc-300 mb-2">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $gym->phone) }}" 
                                    class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="address" class="block text-sm font-medium text-zinc-300 mb-2">Address</label>
                                <textarea name="address" id="address" rows="3" 
                                    class="w-full px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('address', $gym->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>

        @fluxScripts
    </body>
</html>
