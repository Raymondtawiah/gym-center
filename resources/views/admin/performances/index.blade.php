<x-layouts::app-main title="Performance Records - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">Performance Records</h1>
                <p class="text-zinc-400 text-sm mt-1">Track and manage client fitness assessments</p>
            </div>
            <a href="{{ route('admin.performances.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Record
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-4 sm:p-6 mb-6">
            <form method="GET" action="{{ route('admin.performances.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="user_id" class="block text-sm text-zinc-400 mb-1">Client</label>
                    <select name="user_id" id="user_id" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('user_id') == $client->id ? 'selected' : '' }}>{{ $client->first_name }} {{ $client->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_from" class="block text-sm text-zinc-400 mb-1">From</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label for="date_to" class="block text-sm text-zinc-400 mb-1">To</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-500 text-white font-medium px-4 py-2 rounded-lg transition-colors text-sm">Filter</button>
                    @if(request()->hasAny(['user_id', 'date_from', 'date_to']))
                        <a href="{{ route('admin.performances.index') }}" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm rounded-lg transition-colors">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Records List -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            @if($performances->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Weight</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">BMI</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-zinc-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @foreach($performances as $record)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-600/20 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium text-green-400">{{ substr($record->user->first_name ?? '', 0, 1) }}{{ substr($record->user->last_name ?? '', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm text-white">{{ $record->user->first_name }} {{ $record->user->last_name }}</p>
                                                <p class="text-xs text-zinc-500">{{ $record->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">{{ $record->recorded_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">{{ $record->weight ? $record->weight . ' kg' : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($record->bmi)
                                            <span class="text-sm text-zinc-300">{{ $record->bmi }}</span>
                                            <span class="text-xs text-zinc-500 ml-1">({{ $record->bmi_category }})</span>
                                        @else
                                            <span class="text-sm text-zinc-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($record->fitness_score)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-sm font-medium
                                                @if($record->fitness_score >= 7) bg-green-600/20 text-green-400
                                                @elseif($record->fitness_score >= 4) bg-yellow-600/20 text-yellow-400
                                                @else bg-red-600/20 text-red-400 @endif">
                                                {{ $record->fitness_score }}
                                            </span>
                                        @else
                                            <span class="text-sm text-zinc-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('admin.performances.show', $record) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all inline-flex" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.performances.edit', $record) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all inline-flex" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 sm:p-6 border-t border-zinc-800">
                    {{ $performances->appends(request()->query())->links() }}
                </div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-zinc-400 text-lg">No performance records found</p>
                    <p class="text-zinc-500 text-sm mt-1">Create a new record to start tracking client performance</p>
                    <a href="{{ route('admin.performances.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Record
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app-main>
