<nav class="bg-zinc-900/95 backdrop-blur-md border-b border-zinc-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center group-hover:bg-green-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-bold text-white">GymCenter</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                    Home
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Dashboard
                    </a>
                    @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                        <a href="{{ route('admin.bookings.index') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            Bookings
                        </a>
                        <a href="{{ route('admin.bookings.create') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            New Booking
                        </a>
                    @endif
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            Clients
                        </a>
                        <a href="{{ route('admin.gym.staff') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            Staff
                        </a>
                        <a href="{{ route('admin.gym.settings') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            Settings
                        </a>
                    @endif
                    @if(Auth::user()->isClient())
                        <a href="{{ route('client.bookings') }}" class="px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                            My Bookings
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- Desktop User Dropdown (CSS only) -->
                    <div class="hidden md:block relative group">
                        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-zinc-800 transition-all">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-zinc-300">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-zinc-400 transition-transform group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-2 w-56 bg-zinc-800 rounded-xl shadow-xl border border-zinc-700 py-1 z-50 hidden group-hover:block">
                            <div class="px-4 py-3 border-b border-zinc-700">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-zinc-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-zinc-300 hover:bg-zinc-700 hover:text-white cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                            </div>
                            <div class="border-t border-zinc-700 py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-400 hover:bg-zinc-700 hover:text-red-300 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Avatar -->
                    <div class="md:hidden">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-zinc-300 hover:text-white transition-colors">
                        Log in
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                            Register
                        </a>
                    @endif
                @endauth

                <!-- Mobile Menu Toggle -->
                <label for="mobile-menu-toggle" class="md:hidden p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all cursor-pointer">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (CSS checkbox toggle) -->
    <input type="checkbox" id="mobile-menu-toggle" class="hidden peer">
    <div class="hidden peer-checked:block md:hidden border-t border-zinc-800">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                Home
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                    Dashboard
                </a>
                @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                    <a href="{{ route('admin.bookings.index') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Bookings
                    </a>
                    <a href="{{ route('admin.bookings.create') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        New Booking
                    </a>
                @endif
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Clients
                    </a>
                    <a href="{{ route('admin.gym.staff') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Staff
                    </a>
                    <a href="{{ route('admin.gym.settings') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Settings
                    </a>
                @endif
                @if(Auth::user()->isClient())
                    <a href="{{ route('client.bookings') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        My Bookings
                    </a>
                @endif
                <div class="border-t border-zinc-800 pt-2 mt-2">
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-sm rounded-lg text-red-400 hover:text-red-300 hover:bg-zinc-800 transition-all">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-zinc-800 pt-2 mt-2 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-sm rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all text-center">
                        Log in
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-sm bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-all text-center">
                            Register
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
