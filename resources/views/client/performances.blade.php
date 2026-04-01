<x-layouts::app-main title="My Performance - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">My Performance</h1>
            <p class="mt-1 sm:mt-2 text-zinc-400">Track your fitness progress over time</p>
        </div>

        @if($chartData['labels'] && count(array_filter($chartData['labels'])) > 0)
        <!-- Performance Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 sm:mb-8">
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
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 sm:mb-8">
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

        <!-- Filters -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 sm:mb-8">
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Filter Records</h2>
            <form method="GET" action="{{ route('client.performances') }}" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="date_from" class="block text-sm text-zinc-400 mb-1">From</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 sm:px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-green-500 text-sm sm:text-base">
                    </div>
                    <div>
                        <label for="date_to" class="block text-sm text-zinc-400 mb-1">To</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 sm:px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-green-500 text-sm sm:text-base">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-500 text-white font-medium px-4 py-2 rounded-lg transition-colors text-sm sm:text-base">
                            Filter
                        </button>
                        @if(request()->hasAny(['date_from', 'date_to']))
                            <a href="{{ route('client.performances') }}" class="px-4 py-2 text-zinc-400 hover:text-white transition-colors text-sm">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Performance Records -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-white/10">
                <h2 class="text-lg sm:text-xl font-semibold text-white">Assessment History ({{ $performances->total() }})</h2>
            </div>

            @if($performances->count() > 0)
                <div class="divide-y divide-white/10">
                    @foreach($performances as $record)
                        <div class="p-4 sm:p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    @if($record->fitness_score)
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg font-bold
                                            @if($record->fitness_score >= 7) bg-green-600/20 text-green-400
                                            @elseif($record->fitness_score >= 4) bg-yellow-600/20 text-yellow-400
                                            @else bg-red-600/20 text-red-400 @endif">
                                            {{ $record->fitness_score }}
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-zinc-800 text-zinc-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-white font-medium text-base sm:text-lg">{{ $record->recorded_date->format('F d, Y') }}</p>
                                        <div class="flex flex-wrap items-center gap-3 mt-1 text-xs sm:text-sm text-zinc-400">
                                            @if($record->weight)<span>{{ $record->weight }} kg</span>@endif
                                            @if($record->bmi)<span>BMI: {{ $record->bmi }}</span>@endif
                                            @if($record->body_fat_percentage)<span>{{ $record->body_fat_percentage }}% fat</span>@endif
                                            @if($record->bench_press_max)<span>Bench: {{ $record->bench_press_max }} kg</span>@endif
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('client.performances.show', $record) }}" class="bg-green-600 hover:bg-green-500 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center gap-2 text-xs sm:text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 sm:p-6 border-t border-white/10 overflow-x-auto">
                    <div class="min-w-max">
                        {{ $performances->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-zinc-400 text-base sm:text-lg">No performance records found</p>
                    <p class="text-zinc-500 text-sm mt-1">Your trainer will add assessment records after your sessions</p>
                </div>
            @endif
        </div>
    </div>

    @if(isset($chartData) && $chartData['labels'] && count(array_filter($chartData['labels'])) > 0)
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
                    {
                        label: 'Weight (kg)',
                        data: @json($chartData['weight']),
                        borderColor: 'rgb(34,197,94)',
                        backgroundColor: makeGradient(wCtx, 'rgba(34,197,94,1)'),
                        pointBorderColor: 'rgb(34,197,94)',
                        spanGaps: true
                    },
                    {
                        label: 'BMI',
                        data: @json($chartData['bmi']),
                        borderColor: 'rgb(59,130,246)',
                        backgroundColor: makeGradient(wCtx, 'rgba(59,130,246,1)'),
                        pointBorderColor: 'rgb(59,130,246)',
                        spanGaps: true
                    }
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
                    {
                        label: 'Body Fat %',
                        data: @json($chartData['body_fat']),
                        borderColor: 'rgb(239,68,68)',
                        backgroundColor: makeGradient(bcCtx, 'rgba(239,68,68,1)'),
                        pointBorderColor: 'rgb(239,68,68)',
                        spanGaps: true
                    },
                    {
                        label: 'Muscle Mass (kg)',
                        data: @json($chartData['muscle_mass']),
                        borderColor: 'rgb(168,85,247)',
                        backgroundColor: makeGradient(bcCtx, 'rgba(168,85,247,1)'),
                        pointBorderColor: 'rgb(168,85,247)',
                        spanGaps: true
                    }
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
                    {
                        label: 'Bench Press (kg)',
                        data: @json($chartData['bench_press']),
                        borderColor: 'rgb(234,179,8)',
                        backgroundColor: makeGradient(sCtx, 'rgba(234,179,8,1)'),
                        pointBorderColor: 'rgb(234,179,8)',
                        spanGaps: true
                    },
                    {
                        label: 'Squat (kg)',
                        data: @json($chartData['squat']),
                        borderColor: 'rgb(249,115,22)',
                        backgroundColor: makeGradient(sCtx, 'rgba(249,115,22,1)'),
                        pointBorderColor: 'rgb(249,115,22)',
                        spanGaps: true
                    },
                    {
                        label: 'Deadlift (kg)',
                        data: @json($chartData['deadlift']),
                        borderColor: 'rgb(236,72,153)',
                        backgroundColor: makeGradient(sCtx, 'rgba(236,72,153,1)'),
                        pointBorderColor: 'rgb(236,72,153)',
                        spanGaps: true
                    }
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
                    {
                        label: 'Fitness Score',
                        data: @json($chartData['fitness_score']),
                        borderColor: 'rgb(6,182,212)',
                        backgroundColor: makeGradient(fCtx, 'rgba(6,182,212,1)'),
                        pointBorderColor: 'rgb(6,182,212)',
                        spanGaps: true
                    }
                ]
            },
            options: {
                ...chartDefaults,
                scales: {
                    ...chartDefaults.scales,
                    y: { ...chartDefaults.scales.y, min: 0, max: 10 }
                }
            }
        });
    </script>
    @endif
</x-layouts::app-main>
