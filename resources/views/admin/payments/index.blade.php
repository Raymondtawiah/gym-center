<x-layouts::app-main title="Payments - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">Payments</h1>
                <p class="text-zinc-400 text-sm mt-1">Track and manage client payments</p>
            </div>
            <a href="{{ route('admin.payments.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Record Payment
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                <p class="text-xs text-zinc-500 uppercase tracking-wider">Total Collected</p>
                <p class="text-2xl font-bold text-green-400 mt-1">USD {{ number_format($totalAmount, 2) }}</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                <p class="text-xs text-zinc-500 uppercase tracking-wider">Total Records</p>
                <p class="text-2xl font-bold text-white mt-1">{{ $payments->total() }}</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                <p class="text-xs text-zinc-500 uppercase tracking-wider">This Page</p>
                <p class="text-2xl font-bold text-white mt-1">{{ $payments->count() }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-4 sm:p-6 mb-6">
            <form method="GET" action="{{ route('admin.payments.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
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
                    <label for="status" class="block text-sm text-zinc-400 mb-1">Status</label>
                    <select name="status" id="status" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">All</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div>
                    <label for="payment_method" class="block text-sm text-zinc-400 mb-1">Method</label>
                    <select name="payment_method" id="payment_method" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">All</option>
                        <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="mobile_money" {{ request('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                    </select>
                </div>
                <div>
                    <label for="date_from" class="block text-sm text-zinc-400 mb-1">From</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-500 text-white font-medium px-4 py-2 rounded-lg transition-colors text-sm">Filter</button>
                    @if(request()->hasAny(['user_id', 'status', 'payment_method', 'date_from', 'date_to']))
                        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm rounded-lg transition-colors">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Payments Table -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            @if($payments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Method</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">For</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-zinc-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @foreach($payments as $payment)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-600/20 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium text-green-400">{{ substr($payment->user->first_name ?? '', 0, 1) }}{{ substr($payment->user->last_name ?? '', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm text-white">{{ $payment->user->first_name }} {{ $payment->user->last_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">{{ $payment->payment_method_label }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">{{ $payment->payment_for_label }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-300">{{ $payment->payment_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                            @if($payment->status === 'completed') bg-green-600/20 text-green-400
                                            @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
                                            @elseif($payment->status === 'refunded') bg-blue-600/20 text-blue-400
                                            @else bg-red-600/20 text-red-400 @endif">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('admin.payments.show', $payment) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all inline-flex" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.payments.edit', $payment) }}" class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-all inline-flex" title="Edit">
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
                    {{ $payments->appends(request()->query())->links() }}
                </div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-zinc-400 text-lg">No payments found</p>
                    <p class="text-zinc-500 text-sm mt-1">Record a payment to start tracking</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app-main>
