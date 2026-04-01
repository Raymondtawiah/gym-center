<x-layouts::app-main title="{{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Client Registration' }} - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">{{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register New Client' : 'Client Registration' }}</h1>
            <p class="text-zinc-400 mt-1">{{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Add a new member to your gym' : 'Register as a new gym member' }}</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('client.register.store') }}" class="space-y-8">
                    @csrf

                    <!-- Personal Information -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Personal Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-zinc-400 mb-2">First Name <span class="text-red-400">*</span></label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required autofocus
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="First name">
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-zinc-400 mb-2">Last Name <span class="text-red-400">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Last name">
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-400 mb-2">Email <span class="text-red-400">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="email@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-zinc-400 mb-2">Phone <span class="text-red-400">*</span></label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Phone number">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-zinc-400 mb-2">Date of Birth <span class="text-red-400">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-zinc-400 mb-2">Address</label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Full address">
                                @error('address')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Emergency Contact</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="emergency_contact_name" class="block text-sm font-medium text-zinc-400 mb-2">Contact Name <span class="text-red-400">*</span></label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Contact name">
                                @error('emergency_contact_name')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="emergency_contact_phone" class="block text-sm font-medium text-zinc-400 mb-2">Contact Phone <span class="text-red-400">*</span></label>
                                <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Contact phone">
                                @error('emergency_contact_phone')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Membership -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Membership</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="membership_type" class="block text-sm font-medium text-zinc-400 mb-2">Membership Type <span class="text-red-400">*</span></label>
                                <select name="membership_type" id="membership_type" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Select type...</option>
                                    <option value="basic" {{ old('membership_type') == 'basic' ? 'selected' : '' }}>Basic - Access to gym equipment</option>
                                    <option value="premium" {{ old('membership_type') == 'premium' ? 'selected' : '' }}>Premium - Full access + classes</option>
                                    <option value="vip" {{ old('membership_type') == 'vip' ? 'selected' : '' }}>VIP - Full access + personal trainer</option>
                                </select>
                                @error('membership_type')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Security -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Account Security</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="password" class="block text-sm font-medium text-zinc-400 mb-2">Password <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                        class="w-full px-4 py-2.5 pr-10 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Password">
                                    <button type="button" class="absolute right-0 top-0 h-full px-3 flex items-center" onclick="togglePassword('password')">
                                        <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400 hover:text-zinc-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-zinc-400 mb-2">Confirm Password <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="w-full px-4 py-2.5 pr-10 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Confirm password">
                                    <button type="button" class="absolute right-0 top-0 h-full px-3 flex items-center" onclick="togglePassword('password_confirmation')">
                                        <svg id="password_confirmation-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400 hover:text-zinc-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="terms" id="terms" required class="mt-1 w-4 h-4 text-green-600 bg-zinc-800 border-zinc-700 rounded focus:ring-green-500">
                        <label for="terms" class="text-sm text-zinc-400">
                            I agree to the <a href="{{ route('terms') }}" class="text-green-500 hover:text-green-400">Terms</a> and <a href="{{ route('privacy') }}" class="text-green-500 hover:text-green-400">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ url()->previous() }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            {{ auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Register Client' : 'Register' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @fluxScripts

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '-eye');
            
            if (input.type === 'password') {
                input.type = 'text';
                eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = 'password';
                eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</x-layouts::app-main>
