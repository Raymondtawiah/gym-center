<x-layouts::app-main title="My Payments - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">My Payments</h1>
            <p class="mt-1 sm:mt-2 text-zinc-400">View your payment history and receipts</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 sm:mb-8">
            <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-5">
                <p class="text-xs text-zinc-500 uppercase tracking-wider">Total Paid</p>
                <p class="text-2xl font-bold text-green-400 mt-1">USD {{ number_format($totalPaid, 2) }}</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-5">
                <p class="text-xs text-zinc-500 uppercase tracking-wider">Pending</p>
                <p class="text-2xl font-bold text-yellow-400 mt-1">USD {{ number_format($totalPending, 2) }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-6 sm:mb-8">
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Filter</h2>
            <form method="GET" action="{{ route('client.payments') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="status" class="block text-sm text-zinc-400 mb-1">Status</label>
                    <select name="status" id="status" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">All</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
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
                    @if(request()->hasAny(['status', 'date_from', 'date_to']))
                        <a href="{{ route('client.payments') }}" class="px-4 py-2 text-zinc-400 hover:text-white transition-colors text-sm">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Payments List -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-white/10">
                <h2 class="text-lg sm:text-xl font-semibold text-white">Payment History ({{ $payments->total() }})</h2>
            </div>

            @if($payments->count() > 0)
                <div class="divide-y divide-white/10">
                    @foreach($payments as $payment)
                        <div class="p-4 sm:p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                        @if($payment->status === 'completed') bg-green-600/20 text-green-400
                                        @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
                                        @elseif($payment->status === 'refunded') bg-blue-600/20 text-blue-400
                                        @else bg-red-600/20 text-red-400 @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-base sm:text-lg">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
                                        <div class="flex flex-wrap items-center gap-3 mt-1 text-xs sm:text-sm text-zinc-400">
                                            <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full
                                                @if($payment->status === 'completed') bg-green-600/20 text-green-400
                                                @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
                                                @elseif($payment->status === 'refunded') bg-blue-600/20 text-blue-400
                                                @else bg-red-600/20 text-red-400 @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                            <span>{{ $payment->payment_method_label }}</span>
                                            <span>{{ $payment->payment_for_label }}</span>
                                            <span>{{ $payment->payment_date->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('client.payments.show', $payment) }}" class="bg-green-600 hover:bg-green-500 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center gap-2 text-xs sm:text-sm">
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
                    <div class="min-w-max">{{ $payments->appends(request()->query())->links() }}</div>
                </div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-zinc-400 text-base sm:text-lg">No payments found</p>
                    <p class="text-zinc-500 text-sm mt-1">Your payment history will appear here</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app-main>
