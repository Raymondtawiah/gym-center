<x-layouts::app-main title="Client Performance History - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <a href="{{ route('admin.performances.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to All Records
        </a>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <p class="text-zinc-400 text-sm mt-1">Performance history and progress tracking</p>
            </div>
            <a href="{{ route('admin.performances.create', ['user_id' => $user->id]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Record
            </a>
        </div>

        <!-- Records -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            @if($performances->count() > 0)
                <div class="divide-y divide-zinc-800">
                    @foreach($performances as $record)
                        <div class="p-4 sm:p-6 hover:bg-zinc-800/50 transition-colors">
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
                                        <p class="text-white font-medium">{{ $record->recorded_date->format('F d, Y') }}</p>
                                        <div class="flex flex-wrap items-center gap-3 mt-1 text-sm text-zinc-400">
                                            @if($record->weight)<span>{{ $record->weight }} kg</span>@endif
                                            @if($record->bmi)<span>BMI: {{ $record->bmi }}</span>@endif
                                            @if($record->body_fat_percentage)<span>{{ $record->body_fat_percentage }}% fat</span>@endif
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.performances.show', $record) }}" class="inline-flex items-center gap-2 text-sm text-green-400 hover:text-green-300 transition-colors">
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 sm:p-6 border-t border-zinc-800">
                    {{ $performances->appends(request()->query())->links() }}
                </div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-zinc-400 text-lg">No performance records yet</p>
                    <p class="text-zinc-500 text-sm mt-1">Create the first assessment for this client</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app-main>
