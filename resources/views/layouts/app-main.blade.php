<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php use Illuminate\Support\Facades\Session; @endphp
        <title>{{ $title ?? 'GymCenter' }}</title>
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
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-zinc-300 hover:text-white transition-colors">Dashboard</a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.users.index') }}" class="text-zinc-300 hover:text-white transition-colors">Client</a>
                                    <a href="{{ route('admin.gym.staff') }}" class="text-zinc-300 hover:text-white transition-colors">Staff</a>
                                @endif
                                @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                                    <a href="{{ route('admin.bookings.index') }}" class="text-zinc-300 hover:text-white transition-colors">Bookings</a>
                                @endif
                                <a href="{{ route('client.bookings') }}" class="text-zinc-300 hover:text-white transition-colors">My Bookings</a>
                            @endauth
                        </nav>
                        
                        <!-- User Menu -->
                        <div class="flex items-center gap-3">
                            @auth
                                <div class="relative">
                                    <button id="user-menu-button" class="flex items-center gap-2 text-zinc-300 hover:text-white transition-colors focus:outline-none">
                                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Dropdown Menu -->
                                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-zinc-800 rounded-lg shadow-lg border border-zinc-700 py-2 z-50">
                                        <a href="{{ route('profile.edit') }}" class="block w-full text-left px-6 py-3 text-base text-zinc-300 hover:bg-zinc-700 hover:text-white transition-colors whitespace-nowrap">
                                            Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-6 py-3 text-base text-red-400 hover:bg-zinc-700 hover:text-white transition-colors whitespace-nowrap">
                                                Log out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('user-menu-button').addEventListener('click', function() {
                                        var dropdown = document.getElementById('user-dropdown');
                                        dropdown.classList.toggle('hidden');
                                    });
                                    
                                    // Close dropdown when clicking outside
                                    document.addEventListener('click', function(event) {
                                        var button = document.getElementById('user-menu-button');
                                        var dropdown = document.getElementById('user-dropdown');
                                        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                            dropdown.classList.add('hidden');
                                        }
                                    });
                                </script>
                            @else
                                <a href="{{ route('login') }}" class="text-zinc-300 hover:text-white transition-colors">Log in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
