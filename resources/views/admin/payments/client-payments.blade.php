<x-layouts::app-main title="Client Payments - GymCenter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to All Payments
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <p class="text-zinc-400 text-sm mt-1">Payment history - Total paid: USD {{ number_format($totalPaid, 2) }}</p>
            </div>
            <a href="{{ route('admin.payments.create', ['user_id' => $user->id]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Record Payment
            </a>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            @if($payments->count() > 0)
                <div class="divide-y divide-zinc-800">
                    @foreach($payments as $payment)
                        <div class="p-4 sm:p-6 flex items-center justify-between hover:bg-zinc-800/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                                    @if($payment->status === 'completed') bg-green-600/20 text-green-400
                                    @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
                                    @else bg-red-600/20 text-red-400 @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-white font-medium">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
                                    <div class="flex flex-wrap items-center gap-3 mt-1 text-xs text-zinc-400">
                                        <span>{{ $payment->payment_method_label }}</span>
                                        <span>{{ $payment->payment_for_label }}</span>
                                        <span>{{ $payment->payment_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.payments.show', $payment) }}" class="text-sm text-green-400 hover:text-green-300">View</a>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 sm:p-6 border-t border-zinc-800">{{ $payments->appends(request()->query())->links() }}</div>
            @else
                <div class="p-8 sm:p-12 text-center">
                    <p class="text-zinc-400">No payments recorded for this client</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app-main>
