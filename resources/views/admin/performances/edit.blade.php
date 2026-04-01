<x-layouts::app-main title="Edit Performance Record - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('admin.performances.show', $performance) }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Record
        </a>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Edit Performance Record</h1>
            <p class="text-zinc-400 mt-1">{{ $performance->user->first_name }} {{ $performance->user->last_name }} - {{ $performance->recorded_date->format('F d, Y') }}</p>
        </div>

        <!-- Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.performances.update', $performance) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Date -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">General</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-zinc-400 mb-2">Client</label>
                                <p class="text-white font-medium">{{ $performance->user->first_name }} {{ $performance->user->last_name }}</p>
                            </div>
                            <div>
                                <label for="recorded_date" class="block text-sm font-medium text-zinc-400 mb-2">Assessment Date <span class="text-red-400">*</span></label>
                                <input type="date" name="recorded_date" id="recorded_date" value="{{ old('recorded_date', $performance->recorded_date->format('Y-m-d')) }}" required
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @error('recorded_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Body Measurements -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Body Measurements</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                            <div>
                                <label for="weight" class="block text-sm font-medium text-zinc-400 mb-2">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight', $performance->weight) }}" placeholder="70.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="height" class="block text-sm font-medium text-zinc-400 mb-2">Height (cm)</label>
                                <input type="number" step="0.01" name="height" id="height" value="{{ old('height', $performance->height) }}" placeholder="175.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="body_fat_percentage" class="block text-sm font-medium text-zinc-400 mb-2">Body Fat %</label>
                                <input type="number" step="0.01" name="body_fat_percentage" id="body_fat_percentage" value="{{ old('body_fat_percentage', $performance->body_fat_percentage) }}" placeholder="15.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="muscle_mass" class="block text-sm font-medium text-zinc-400 mb-2">Muscle Mass (kg)</label>
                                <input type="number" step="0.01" name="muscle_mass" id="muscle_mass" value="{{ old('muscle_mass', $performance->muscle_mass) }}" placeholder="30.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Vital Stats -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Vital Stats</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="resting_heart_rate" class="block text-sm font-medium text-zinc-400 mb-2">Resting Heart Rate (BPM)</label>
                                <input type="number" name="resting_heart_rate" id="resting_heart_rate" value="{{ old('resting_heart_rate', $performance->resting_heart_rate) }}" placeholder="72"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="blood_pressure" class="block text-sm font-medium text-zinc-400 mb-2">Blood Pressure</label>
                                <input type="text" name="blood_pressure" id="blood_pressure" value="{{ old('blood_pressure', $performance->blood_pressure) }}" placeholder="120/80"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Strength Benchmarks -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Strength Benchmarks</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div>
                                <label for="bench_press_max" class="block text-sm font-medium text-zinc-400 mb-2">Bench Press Max (kg)</label>
                                <input type="number" step="0.01" name="bench_press_max" id="bench_press_max" value="{{ old('bench_press_max', $performance->bench_press_max) }}" placeholder="80.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="squat_max" class="block text-sm font-medium text-zinc-400 mb-2">Squat Max (kg)</label>
                                <input type="number" step="0.01" name="squat_max" id="squat_max" value="{{ old('squat_max', $performance->squat_max) }}" placeholder="100.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="deadlift_max" class="block text-sm font-medium text-zinc-400 mb-2">Deadlift Max (kg)</label>
                                <input type="number" step="0.01" name="deadlift_max" id="deadlift_max" value="{{ old('deadlift_max', $performance->deadlift_max) }}" placeholder="120.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Cardio & Flexibility -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Cardio & Flexibility</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div>
                                <label for="cardio_duration" class="block text-sm font-medium text-zinc-400 mb-2">Cardio Duration (min)</label>
                                <input type="number" name="cardio_duration" id="cardio_duration" value="{{ old('cardio_duration', $performance->cardio_duration) }}" placeholder="30"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="cardio_distance" class="block text-sm font-medium text-zinc-400 mb-2">Cardio Distance (km)</label>
                                <input type="number" step="0.01" name="cardio_distance" id="cardio_distance" value="{{ old('cardio_distance', $performance->cardio_distance) }}" placeholder="5.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="sit_and_reach" class="block text-sm font-medium text-zinc-400 mb-2">Sit & Reach (cm)</label>
                                <input type="number" step="0.01" name="sit_and_reach" id="sit_and_reach" value="{{ old('sit_and_reach', $performance->sit_and_reach) }}" placeholder="25.00"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Assessment -->
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Assessment</h2>
                        <div class="space-y-5">
                            <div>
                                <label for="fitness_score" class="block text-sm font-medium text-zinc-400 mb-2">Fitness Score (1-10)</label>
                                <input type="number" min="1" max="10" name="fitness_score" id="fitness_score" value="{{ old('fitness_score', $performance->fitness_score) }}" placeholder="7"
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-zinc-400 mb-2">Notes</label>
                                <textarea name="notes" id="notes" rows="3" placeholder="General observations..."
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('notes', $performance->notes) }}</textarea>
                            </div>
                            <div>
                                <label for="recommendations" class="block text-sm font-medium text-zinc-400 mb-2">Recommendations</label>
                                <textarea name="recommendations" id="recommendations" rows="3" placeholder="Training and nutrition recommendations..."
                                    class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('recommendations', $performance->recommendations) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('admin.performances.show', $performance) }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            Update Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app-main>
