<x-layouts::app-main title="Dashboard - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-white">
                @if(Auth::user()->role === 'admin')
                    Admin Dashboard
                @elseif(Auth::user()->role === 'staff')
                    Staff Dashboard
                @else
                    Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name }}
                @endif
            </h1>
            <p class="text-zinc-400 mt-1">
                @if(Auth::user()->role === 'admin')
                    Manage your gym center from here.
                @elseif(Auth::user()->role === 'staff')
                    Manage bookings and assist clients.
                @else
                    Manage your memberships and profile.
                @endif
            </p>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">My Profile</h2>
                <p class="text-sm text-zinc-500">View and edit your profile</p>
            </a>

            @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
            <!-- Bookings -->
            <a href="{{ route('admin.bookings.index') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">Bookings</h2>
                <p class="text-sm text-zinc-500">Manage all bookings</p>
            </a>
            @endif

            @if(Auth::user()->isAdmin())
            <!-- Register Client -->
            <a href="{{ route('client.register') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">Register Client</h2>
                <p class="text-sm text-zinc-500">Add a new gym member</p>
            </a>

            <!-- Clients -->
            <a href="{{ route('admin.users.index') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">Clients</h2>
                <p class="text-sm text-zinc-500">View all gym members</p>
            </a>

            <!-- Staff -->
            <a href="{{ route('admin.gym.staff') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">Staff</h2>
                <p class="text-sm text-zinc-500">Manage gym staff</p>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.gym.settings') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-zinc-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-zinc-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">Settings</h2>
                <p class="text-sm text-zinc-500">Configure gym details</p>
            </a>
            @endif

            @if(Auth::user()->isClient())
            <!-- My Bookings -->
            <a href="{{ route('client.bookings') }}" class="group bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 transition-all">
                <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-500/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-white mb-1">My Membership</h2>
                <p class="text-sm text-zinc-500">View your memberships</p>
            </a>
            @endif
        </div>
    </div>
</x-layouts::app-main>
