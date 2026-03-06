<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php use Illuminate\Support\Facades\Session; @endphp
        <title>Dashboard - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
        <!-- Toast Notifications -->
        @include('components.toast')
        
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-xl font-bold text-white">GymCenter</span>
                        </a>
                        
                        <!-- Navigation -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="{{ route('home') }}" class="text-zinc-300 hover:text-white transition-colors">Home</a>
                        </nav>
                        
                        <!-- User Menu -->
                        <div class="flex items-center gap-3">
                            <span class="text-zinc-300">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-medium rounded-lg transition-colors">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Welcome Message -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-white mb-4">
                            @if(Auth::user()->role === 'admin')
                                Admin Dashboard
                            @else
                                Welcome to Your Dashboard
                            @endif
                        </h1>
                        <p class="text-zinc-400">
                            @if(Auth::user()->role === 'admin')
                                Manage your gym center from here.
                            @else
                                Manage your bookings and profile.
                            @endif
                        </p>
                    </div>

                    <!-- Dashboard Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Profile Card -->
                        <a href="{{ route('profile.edit') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">My Profile</h2>
                            </div>
                            <p class="text-zinc-400">View and edit your profile</p>
                        </a>

                        @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                        <!-- Admin/Staff: Manage Bookings -->
                        <a href="{{ route('admin.bookings.index') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-purple-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">Manage Bookings</h2>
                            </div>
                            <p class="text-zinc-400">View and manage all bookings</p>
                        </a>

                        <!-- Admin/Staff: Register Client -->
                        <a href="{{ route('client.register') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-yellow-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">Register Client</h2>
                            </div>
                            <p class="text-zinc-400">Register new clients manually</p>
                        </a>
                        @endif

                        @if(Auth::user()->isAdmin())
                        <!-- Admin: Manage Users -->
                        <a href="{{ route('admin.users.index') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-green-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">Manage Users</h2>
                            </div>
                            <p class="text-zinc-400">View and manage all users</p>
                        </a>

                        <!-- Admin: Staff Management -->
                        <a href="{{ route('admin.gym.staff') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-indigo-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">Staff Management</h2>
                            </div>
                            <p class="text-zinc-400">Manage gym staff members</p>
                        </a>
                        @elseif(Auth::user()->isClient())
                        <!-- Client: My Bookings -->
                        <a href="{{ route('client.bookings') }}" class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center justify-center w-12 h-12 bg-purple-600/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-white">My Membership</h2>
                            </div>
                            <p class="text-zinc-400">View your memberships</p>
                        </a>
                        @endif
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-zinc-900 border-t border-zinc-800 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-white font-semibold">GymCenter</span>
                        </div>
                        <p class="text-zinc-400 text-sm">
                            © <span id="year"></span> GymCenter. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</html>
