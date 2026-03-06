<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Create Booking - GymCenter Admin</title>
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
                            <a href="{{ route('dashboard') }}" class="text-zinc-300 hover:text-white transition-colors">Dashboard</a>
                            <a href="{{ route('admin.bookings.index') }}" class="text-green-400 font-medium">Bookings</a>
                            <a href="{{ route('admin.gym.settings') }}" class="text-zinc-300 hover:text-white transition-colors">Gym Settings</a>
                        </nav>
                        
                        <!-- User Menu -->
                        <div class="hidden md:flex items-center gap-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-zinc-300 hover:text-white transition-colors">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Back Link -->
                    <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Bookings
                    </a>

                    <!-- Create Booking Form -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
                        <div class="bg-green-600/20 px-6 py-4 border-b border-white/10">
                            <h1 class="text-2xl font-bold text-white">Create New Booking</h1>
                        </div>
                        
                        <div class="p-6">
                            <form method="POST" action="{{ route('admin.bookings.store') }}" class="space-y-6">
                                @csrf
                                
                                <!-- Select User -->
                                <div>
                                    <label for="user_id" class="block text-sm font-medium text-zinc-300 mb-2">
                                        Select Client <span class="text-red-400">*</span>
                                    </label>
                                    <select 
                                        name="user_id" 
                                        id="user_id"
                                        required
                                        class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                    >
                                        <option value="">Select a client</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" data-weight="{{ $user->weight }}" data-height="{{ $user->height }}" data-health-conditions="{{ $user->health_conditions }}" data-allergies="{{ $user->allergies }}" data-medications="{{ $user->medications }}" data-fitness-goals="{{ $user->fitness_goals }}" data-injuries="{{ $user->injuries }}" data-injury-details="{{ $user->injury_details }}">
                                                {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Client Health Information -->
                                <div class="bg-yellow-600/10 border border-yellow-600/30 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-yellow-400 mb-3">Client Health Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="weight" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Weight (kg)
                                            </label>
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                name="weight" 
                                                id="weight"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Weight in kg"
                                            >
                                        </div>
                                        <div>
                                            <label for="height" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Height (cm)
                                            </label>
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                name="height" 
                                                id="height"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Height in cm"
                                            >
                                        </div>
                                        <div>
                                            <label for="injuries" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Any Injuries?
                                            </label>
                                            <select 
                                                name="injuries" 
                                                id="injuries"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                            >
                                                <option value="">Select...</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="injury_details" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Injury Details
                                            </label>
                                            <input 
                                                type="text" 
                                                name="injury_details" 
                                                id="injury_details"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Describe any injuries"
                                            >
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="health_conditions" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Health Conditions
                                            </label>
                                            <textarea 
                                                name="health_conditions" 
                                                id="health_conditions"
                                                rows="2"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Any health conditions..."
                                            ></textarea>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="allergies" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Allergies
                                            </label>
                                            <textarea 
                                                name="allergies" 
                                                id="allergies"
                                                rows="2"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Any allergies..."
                                            ></textarea>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="medications" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Current Medications
                                            </label>
                                            <textarea 
                                                name="medications" 
                                                id="medications"
                                                rows="2"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Any medications..."
                                            ></textarea>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="fitness_goals" class="block text-sm font-medium text-zinc-300 mb-1">
                                                Fitness Goals
                                            </label>
                                            <textarea 
                                                name="fitness_goals" 
                                                id="fitness_goals"
                                                rows="2"
                                                class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                                placeholder="Fitness goals..."
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Membership Type -->
                                <div>
                                    <label for="membership_type" class="block text-sm font-medium text-zinc-300 mb-2">
                                        Membership Type <span class="text-red-400">*</span>
                                    </label>
                                    <select 
                                        name="membership_type" 
                                        id="membership_type"
                                        required
                                        class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                        onchange="calculateEndDate()"
                                    >
                                        <option value="">Select membership type</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    @error('membership_type')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-zinc-300 mb-2">
                                        Start Date <span class="text-red-400">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        name="start_date" 
                                        id="start_date"
                                        value="{{ old('start_date', date('Y-m-d')) }}"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                        class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                        onchange="calculateEndDate()"
                                    >
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-zinc-300 mb-2">
                                        End Date <span class="text-red-400">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        name="end_date" 
                                        id="end_date"
                                        value="{{ old('end_date') }}"
                                        required
                                        class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                    >
                                    <p class="mt-1 text-xs text-zinc-500">Auto-calculated based on membership type, or manually set</p>
                                    @error('end_date')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Notes -->
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-zinc-300 mb-2">
                                        Notes
                                    </label>
                                    <textarea 
                                        name="notes" 
                                        id="notes"
                                        rows="3"
                                        class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Any additional notes about this membership..."
                                    >{{ old('notes') }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-zinc-700 hover:bg-zinc-600 text-white font-medium rounded-lg transition-colors">
                                        Cancel
                                    </a>
                                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                        Create Booking
                                    </button>
                                </div>
                            </form>
                        </div>
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
        @fluxScripts
    </body>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
        
        function calculateEndDate() {
            const membershipType = document.getElementById('membership_type').value;
            const startDateInput = document.getElementById('start_date').value;
            
            if (membershipType && startDateInput) {
                const startDate = new Date(startDateInput);
                let endDate = new Date(startDateInput);
                
                if (membershipType === 'monthly') {
                    endDate.setMonth(endDate.getMonth() + 1);
                } else if (membershipType === 'yearly') {
                    endDate.setFullYear(endDate.getFullYear() + 1);
                }
                
                // Format as YYYY-MM-DD
                const endDateStr = endDate.toISOString().split('T')[0];
                document.getElementById('end_date').value = endDateStr;
            }
        }
    </script>
</html>
