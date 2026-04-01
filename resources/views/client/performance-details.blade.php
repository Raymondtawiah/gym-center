<x-layouts::app-main title="Performance Details - GymCenter">
    <!-- Back Button -->
    <a href="{{ route('client.performances') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white mb-4 sm:mb-6 transition-colors text-sm sm:text-base ml-4 sm:ml-6 lg:mx-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to My Performance
    </a>

    <!-- Header -->
    <div class="mb-6 sm:mb-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-white">Assessment Details</h1>
        <p class="mt-1 sm:mt-2 text-zinc-400">{{ $performance->recorded_date->format('F d, Y') }}</p>
    </div>

    @if(isset($chartData) && $chartData['labels'] && count(array_filter($chartData['labels'])) > 1)
    <!-- Performance Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 mx-4 sm:mx-6 lg:mx-8">
        <!-- Weight & BMI Chart -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6">
            <h2 class="text-lg font-semibold text-white mb-2">Weight & BMI Trend</h2>
            <div class="flex flex-wrap gap-3 mb-4">
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-green-500"></span> Weight (kg)</span>
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-blue-500"></span> BMI</span>
            </div>
            <canvas id="weightChart" height="200"></canvas>
        </div>

        <!-- Body Composition Chart -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6">
            <h2 class="text-lg font-semibold text-white mb-2">Body Composition</h2>
            <div class="flex flex-wrap gap-3 mb-4">
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-red-500"></span> Body Fat %</span>
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-purple-500"></span> Muscle Mass (kg)</span>
            </div>
            <canvas id="bodyCompChart" height="200"></canvas>
        </div>

        <!-- Strength Chart -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6">
            <h2 class="text-lg font-semibold text-white mb-2">Strength Progress</h2>
            <div class="flex flex-wrap gap-3 mb-4">
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-yellow-500"></span> Bench Press</span>
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-orange-500"></span> Squat</span>
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-pink-500"></span> Deadlift</span>
            </div>
            <canvas id="strengthChart" height="200"></canvas>
        </div>

        <!-- Fitness Score Chart -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6">
            <h2 class="text-lg font-semibold text-white mb-2">Fitness Score</h2>
            <div class="flex flex-wrap gap-3 mb-4">
                <span class="flex items-center gap-1.5 text-xs text-zinc-400"><span class="w-3 h-1 rounded-full bg-cyan-500"></span> Score (1-10)</span>
            </div>
            <canvas id="fitnessScoreChart" height="200"></canvas>
        </div>
    </div>

    <!-- Color Legend -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg font-semibold text-white mb-3">Chart Color Guide</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Weight</p>
                    <p class="text-zinc-500 text-xs">Body weight in kg</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">BMI</p>
                    <p class="text-zinc-500 text-xs">Body mass index</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Body Fat</p>
                    <p class="text-zinc-500 text-xs">Fat percentage</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Muscle</p>
                    <p class="text-zinc-500 text-xs">Muscle mass in kg</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Bench Press</p>
                    <p class="text-zinc-500 text-xs">Max in kg</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Squat</p>
                    <p class="text-zinc-500 text-xs">Max in kg</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-pink-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Deadlift</p>
                    <p class="text-zinc-500 text-xs">Max in kg</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-zinc-800/50 rounded-lg p-3">
                <div class="w-3 h-3 rounded-full bg-cyan-500"></div>
                <div>
                    <p class="text-white text-xs font-medium">Fitness</p>
                    <p class="text-zinc-500 text-xs">Score out of 10</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Body Measurements -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Body Measurements</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Weight</p>
                <p class="text-white font-medium text-lg">{{ $performance->weight ? $performance->weight . ' kg' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->weight && $performance->weight)
                    @php $diff = $performance->weight - $previousRecord->weight; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-red-400' : ($diff < 0 ? 'text-green-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }} kg from last
                    </p>
                @endif
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Height</p>
                <p class="text-white font-medium text-lg">{{ $performance->height ? $performance->height . ' cm' : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">BMI</p>
                @if($performance->bmi)
                    <p class="text-white font-medium text-lg">{{ $performance->bmi }}</p>
                    <p class="text-xs text-zinc-500">{{ $performance->bmi_category }}</p>
                @else
                    <p class="text-zinc-500">N/A</p>
                @endif
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Body Fat</p>
                <p class="text-white font-medium text-lg">{{ $performance->body_fat_percentage ? $performance->body_fat_percentage . '%' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->body_fat_percentage && $performance->body_fat_percentage)
                    @php $diff = $performance->body_fat_percentage - $previousRecord->body_fat_percentage; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-red-400' : ($diff < 0 ? 'text-green-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }}% from last
                    </p>
                @endif
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Muscle Mass</p>
                <p class="text-white font-medium text-lg">{{ $performance->muscle_mass ? $performance->muscle_mass . ' kg' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->muscle_mass && $performance->muscle_mass)
                    @php $diff = $performance->muscle_mass - $previousRecord->muscle_mass; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-green-400' : ($diff < 0 ? 'text-red-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }} kg from last
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Vital Stats -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Vital Stats</h2>
        <div class="grid grid-cols-2 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Resting Heart Rate</p>
                <p class="text-white font-medium text-lg">{{ $performance->resting_heart_rate ? $performance->resting_heart_rate . ' BPM' : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Blood Pressure</p>
                <p class="text-white font-medium text-lg">{{ $performance->blood_pressure ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Strength -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Strength Benchmarks</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Bench Press Max</p>
                <p class="text-white font-medium text-lg">{{ $performance->bench_press_max ? $performance->bench_press_max . ' kg' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->bench_press_max && $performance->bench_press_max)
                    @php $diff = $performance->bench_press_max - $previousRecord->bench_press_max; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-green-400' : ($diff < 0 ? 'text-red-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }} kg from last
                    </p>
                @endif
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Squat Max</p>
                <p class="text-white font-medium text-lg">{{ $performance->squat_max ? $performance->squat_max . ' kg' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->squat_max && $performance->squat_max)
                    @php $diff = $performance->squat_max - $previousRecord->squat_max; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-green-400' : ($diff < 0 ? 'text-red-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }} kg from last
                    </p>
                @endif
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Deadlift Max</p>
                <p class="text-white font-medium text-lg">{{ $performance->deadlift_max ? $performance->deadlift_max . ' kg' : 'N/A' }}</p>
                @if($previousRecord && $previousRecord->deadlift_max && $performance->deadlift_max)
                    @php $diff = $performance->deadlift_max - $previousRecord->deadlift_max; @endphp
                    <p class="text-xs {{ $diff > 0 ? 'text-green-400' : ($diff < 0 ? 'text-red-400' : 'text-zinc-500') }}">
                        {{ $diff > 0 ? '+' : '' }}{{ number_format($diff, 1) }} kg from last
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Cardio & Flexibility -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Cardio & Flexibility</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Cardio Duration</p>
                <p class="text-white font-medium text-lg">{{ $performance->cardio_duration ? $performance->cardio_duration . ' min' : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Cardio Distance</p>
                <p class="text-white font-medium text-lg">{{ $performance->cardio_distance ? $performance->cardio_distance . ' km' : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Sit & Reach</p>
                <p class="text-white font-medium text-lg">{{ $performance->sit_and_reach ? $performance->sit_and_reach . ' cm' : 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Fitness Score -->
    @if($performance->fitness_score)
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Fitness Score</h2>
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
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mx-4 sm:mx-6 lg:mx-8">
        @if($performance->notes)
        <div class="mb-6">
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-2">Trainer Notes</h2>
            <p class="text-zinc-300 whitespace-pre-line">{{ $performance->notes }}</p>
        </div>
        @endif
        @if($performance->recommendations)
        <div>
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-2">Recommendations</h2>
            <p class="text-zinc-300 whitespace-pre-line">{{ $performance->recommendations }}</p>
        </div>
        @endif
    </div>
    @endif

    @if(isset($chartData) && $chartData['labels'] && count(array_filter($chartData['labels'])) > 1)
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
        const chartLabels = @json($chartData['labels']);
        const chartDefaults = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: 'rgba(63,63,70,0.3)' }, ticks: { color: '#a1a1aa', font: { size: 11 } } },
                y: { grid: { color: 'rgba(63,63,70,0.3)' }, ticks: { color: '#a1a1aa', font: { size: 11 } } }
            },
            elements: {
                line: { tension: 0.4, borderWidth: 2, fill: true },
                point: { radius: 4, hoverRadius: 6, backgroundColor: '#fff', borderWidth: 2 }
            }
        };

        function makeGradient(ctx, color) {
            const g = ctx.createLinearGradient(0, 0, 0, 200);
            g.addColorStop(0, color.replace('1)', '0.3)').replace('rgb', 'rgba'));
            g.addColorStop(1, color.replace('1)', '0)').replace('rgb', 'rgba'));
            return g;
        }

        // Weight & BMI
        const wCtx = document.getElementById('weightChart').getContext('2d');
        new Chart(wCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Weight (kg)', data: @json($chartData['weight']), borderColor: 'rgb(34,197,94)', backgroundColor: makeGradient(wCtx, 'rgba(34,197,94,1)'), pointBorderColor: 'rgb(34,197,94)', spanGaps: true },
                    { label: 'BMI', data: @json($chartData['bmi']), borderColor: 'rgb(59,130,246)', backgroundColor: makeGradient(wCtx, 'rgba(59,130,246,1)'), pointBorderColor: 'rgb(59,130,246)', spanGaps: true }
                ]
            },
            options: chartDefaults
        });

        // Body Composition
        const bcCtx = document.getElementById('bodyCompChart').getContext('2d');
        new Chart(bcCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Body Fat %', data: @json($chartData['body_fat']), borderColor: 'rgb(239,68,68)', backgroundColor: makeGradient(bcCtx, 'rgba(239,68,68,1)'), pointBorderColor: 'rgb(239,68,68)', spanGaps: true },
                    { label: 'Muscle Mass (kg)', data: @json($chartData['muscle_mass']), borderColor: 'rgb(168,85,247)', backgroundColor: makeGradient(bcCtx, 'rgba(168,85,247,1)'), pointBorderColor: 'rgb(168,85,247)', spanGaps: true }
                ]
            },
            options: chartDefaults
        });

        // Strength
        const sCtx = document.getElementById('strengthChart').getContext('2d');
        new Chart(sCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Bench Press (kg)', data: @json($chartData['bench_press']), borderColor: 'rgb(234,179,8)', backgroundColor: makeGradient(sCtx, 'rgba(234,179,8,1)'), pointBorderColor: 'rgb(234,179,8)', spanGaps: true },
                    { label: 'Squat (kg)', data: @json($chartData['squat']), borderColor: 'rgb(249,115,22)', backgroundColor: makeGradient(sCtx, 'rgba(249,115,22,1)'), pointBorderColor: 'rgb(249,115,22)', spanGaps: true },
                    { label: 'Deadlift (kg)', data: @json($chartData['deadlift']), borderColor: 'rgb(236,72,153)', backgroundColor: makeGradient(sCtx, 'rgba(236,72,153,1)'), pointBorderColor: 'rgb(236,72,153)', spanGaps: true }
                ]
            },
            options: chartDefaults
        });

        // Fitness Score
        const fCtx = document.getElementById('fitnessScoreChart').getContext('2d');
        new Chart(fCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Fitness Score', data: @json($chartData['fitness_score']), borderColor: 'rgb(6,182,212)', backgroundColor: makeGradient(fCtx, 'rgba(6,182,212,1)'), pointBorderColor: 'rgb(6,182,212)', spanGaps: true }
                ]
            },
            options: { ...chartDefaults, scales: { ...chartDefaults.scales, y: { ...chartDefaults.scales.y, min: 0, max: 10 } } }
        });
    </script>
    @endif
</x-layouts::app-main>
