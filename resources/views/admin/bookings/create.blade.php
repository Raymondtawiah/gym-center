<x-layouts::app-main title="Create Booking - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Bookings
        </a>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Create New Booking</h1>
            <p class="text-zinc-400 mt-1">Add a new membership booking for a client</p>
        </div>

        <!-- Create Booking Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.bookings.store') }}" class="space-y-8">
                    @csrf

                    <!-- Select User -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Select Client</h2>
                        <select
                            name="user_id"
                            id="user_id"
                            required
                            class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        >
                            <option value="">Choose a client...</option>
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

                    <!-- Health Information -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Health Information</h2>
                        <div class="bg-zinc-800/50 border border-zinc-700 rounded-xl p-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-zinc-400 mb-2">Weight (kg)</label>
                                    <input type="number" step="0.01" name="weight" id="weight" placeholder="Weight in kg"
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="height" class="block text-sm font-medium text-zinc-400 mb-2">Height (cm)</label>
                                    <input type="number" step="0.01" name="height" id="height" placeholder="Height in cm"
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="injuries" class="block text-sm font-medium text-zinc-400 mb-2">Any Injuries?</label>
                                    <select name="injuries" id="injuries"
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Select...</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="injury_details" class="block text-sm font-medium text-zinc-400 mb-2">Injury Details</label>
                                    <input type="text" name="injury_details" id="injury_details" placeholder="Describe any injuries"
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="health_conditions" class="block text-sm font-medium text-zinc-400 mb-2">Health Conditions</label>
                                    <textarea name="health_conditions" id="health_conditions" rows="2" placeholder="Any health conditions..."
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="allergies" class="block text-sm font-medium text-zinc-400 mb-2">Allergies</label>
                                    <textarea name="allergies" id="allergies" rows="2" placeholder="Any allergies..."
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="medications" class="block text-sm font-medium text-zinc-400 mb-2">Current Medications</label>
                                    <textarea name="medications" id="medications" rows="2" placeholder="Any medications..."
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="fitness_goals" class="block text-sm font-medium text-zinc-400 mb-2">Fitness Goals</label>
                                    <textarea name="fitness_goals" id="fitness_goals" rows="2" placeholder="Fitness goals..."
                                        class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Membership Details -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Membership Details</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="membership_type" class="block text-sm font-medium text-zinc-400 mb-2">Membership Type <span class="text-red-400">*</span></label>
                                <select name="membership_type" id="membership_type" required onchange="calculateEndDate()"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Select type...</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                                @error('membership_type')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-zinc-400 mb-2">Start Date <span class="text-red-400">*</span></label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required onchange="calculateEndDate()"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-zinc-400 mb-2">End Date <span class="text-red-400">*</span></label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <p class="mt-1 text-xs text-zinc-500">Auto-calculated based on membership type</p>
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-zinc-400 mb-2">Notes</label>
                                <textarea name="notes" id="notes" rows="2" placeholder="Additional notes..."
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('admin.bookings.index') }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            Create Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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

                document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
            }
        }
    </script>
</x-layouts::app-main>
