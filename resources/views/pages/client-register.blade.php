<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php use Illuminate\Support\Facades\Session; @endphp
        <title>{{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Client Registration' }} - GymCenter</title>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="min-h-screen bg-zinc-950 text-white antialiased">
        @include('components.toast')

        <x-navbar />

        <div class="max-w-2xl mx-auto px-4 sm:px-6 py-8">
            <!-- Back Link -->
            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Admin
                </a>
            @endif

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="px-6 sm:px-8 py-8">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-white">
                            {{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register New Client' : 'Join GymCenter' }}
                        </h1>
                        <p class="text-zinc-400 text-sm mt-1">
                            {{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Add a new member to your gym' : 'Register as a new gym member' }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('client.register.store') }}" class="space-y-5">
                        @csrf

                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-zinc-400 mb-1.5">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required autofocus
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="First name">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-zinc-400 mb-1.5">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Last name">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-400 mb-1.5">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="email@example.com">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-zinc-400 mb-1.5">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Phone number">
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-zinc-400 mb-1.5">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
                                class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-zinc-400 mb-1.5">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Full address">
                        </div>

                        <!-- Emergency Contact -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="emergency_contact_name" class="block text-sm font-medium text-zinc-400 mb-1.5">Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Contact name">
                            </div>
                            <div>
                                <label for="emergency_contact_phone" class="block text-sm font-medium text-zinc-400 mb-1.5">Emergency Contact Phone</label>
                                <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Contact phone">
                            </div>
                        </div>

                        <!-- Membership Type -->
                        <div>
                            <label for="membership_type" class="block text-sm font-medium text-zinc-400 mb-1.5">Membership Type</label>
                            <select name="membership_type" id="membership_type" required
                                class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Select membership type</option>
                                <option value="basic">Basic - Access to gym equipment</option>
                                <option value="premium">Premium - Full access + classes</option>
                                <option value="vip">VIP - Full access + personal trainer</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-zinc-400 mb-1.5">Password</label>
                                <input type="password" name="password" id="password" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Password">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-zinc-400 mb-1.5">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Confirm password">
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start gap-3 pt-2">
                            <input type="checkbox" name="terms" id="terms" required class="mt-1 w-4 h-4 text-green-600 border-zinc-600 rounded focus:ring-green-500 bg-zinc-800">
                            <label for="terms" class="text-sm text-zinc-400">
                                I agree to the <a href="{{ route('terms') }}" class="text-green-400 hover:underline">Terms</a> and <a href="{{ route('privacy') }}" class="text-green-400 hover:underline">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full px-4 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-xl transition-colors">
                            {{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Register' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
