<x-layouts::app-main title="Performance Record - GymCenter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('admin.performances.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Performance Records
        </a>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Performance Record</h1>
                <p class="text-zinc-400 mt-1">{{ $performance->user->first_name }} {{ $performance->user->last_name }} - {{ $performance->recorded_date->format('F d, Y') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.performances.edit', $performance) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.performances.client-history', $performance->user) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    History
                </a>
            </div>
        </div>

        <!-- Client Info -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Client</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Name</p>
                    <p class="text-white font-medium">{{ $performance->user->first_name }} {{ $performance->user->last_name }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Email</p>
                    <p class="text-white font-medium text-sm">{{ $performance->user->email }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Date</p>
                    <p class="text-white font-medium">{{ $performance->recorded_date->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Body Measurements -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Body Measurements</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Weight</p>
                    <p class="text-white font-medium text-lg">{{ $performance->weight ? $performance->weight . ' kg' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Height</p>
                    <p class="text-white font-medium text-lg">{{ $performance->height ? $performance->height . ' cm' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">BMI</p>
                    @if($performance->bmi)
                        <p class="text-white font-medium text-lg">{{ $performance->bmi }}</p>
                        <p class="text-xs text-zinc-500">{{ $performance->bmi_category }}</p>
                    @else
                        <p class="text-zinc-500">N/A</p>
                    @endif
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Body Fat</p>
                    <p class="text-white font-medium text-lg">{{ $performance->body_fat_percentage ? $performance->body_fat_percentage . '%' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Muscle Mass</p>
                    <p class="text-white font-medium text-lg">{{ $performance->muscle_mass ? $performance->muscle_mass . ' kg' : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Vitals -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Vital Stats</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Resting Heart Rate</p>
                    <p class="text-white font-medium text-lg">{{ $performance->resting_heart_rate ? $performance->resting_heart_rate . ' BPM' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Blood Pressure</p>
                    <p class="text-white font-medium text-lg">{{ $performance->blood_pressure ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Strength -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Strength Benchmarks</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Bench Press</p>
                    <p class="text-white font-medium text-lg">{{ $performance->bench_press_max ? $performance->bench_press_max . ' kg' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Squat</p>
                    <p class="text-white font-medium text-lg">{{ $performance->squat_max ? $performance->squat_max . ' kg' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Deadlift</p>
                    <p class="text-white font-medium text-lg">{{ $performance->deadlift_max ? $performance->deadlift_max . ' kg' : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Cardio & Flexibility -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Cardio & Flexibility</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Cardio Duration</p>
                    <p class="text-white font-medium text-lg">{{ $performance->cardio_duration ? $performance->cardio_duration . ' min' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Cardio Distance</p>
                    <p class="text-white font-medium text-lg">{{ $performance->cardio_distance ? $performance->cardio_distance . ' km' : 'N/A' }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Sit & Reach</p>
                    <p class="text-white font-medium text-lg">{{ $performance->sit_and_reach ? $performance->sit_and_reach . ' cm' : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Fitness Score -->
        @if($performance->fitness_score)
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Fitness Score</h2>
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-xl flex items-center justify-center text-2xl font-bold
                    @if($performance->fitness_score >= 7) bg-green-600/20 text-green-400
                    @elseif($performance->fitness_score >= 4) bg-yellow-600/20 text-yellow-400
                    @else bg-red-600/20 text-red-400 @endif">
                    {{ $performance->fitness_score }}
                </div>
                <div>
                    <p class="text-white font-medium">out of 10</p>
                    <p class="text-zinc-400 text-sm">
                        @if($performance->fitness_score >= 7) Excellent condition
                        @elseif($performance->fitness_score >= 4) Average condition
                        @else Needs improvement @endif
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Notes & Recommendations -->
        @if($performance->notes || $performance->recommendations)
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
            @if($performance->notes)
            <div class="mb-6">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-2">Notes</h2>
                <p class="text-zinc-300 text-sm whitespace-pre-line">{{ $performance->notes }}</p>
            </div>
            @endif
            @if($performance->recommendations)
            <div>
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-2">Recommendations</h2>
                <p class="text-zinc-300 text-sm whitespace-pre-line">{{ $performance->recommendations }}</p>
            </div>
            @endif
        </div>
        @endif
    </div>
</x-layouts::app-main>
