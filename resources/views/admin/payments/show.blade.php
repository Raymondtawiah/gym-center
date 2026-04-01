<x-layouts::app-main title="Payment Details - GymCenter">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Payments
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Payment #{{ $payment->id }}</h1>
                <p class="text-zinc-400 mt-1">{{ $payment->payment_date->format('F d, Y') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.payments.edit', $payment) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit
                </a>
                <a href="{{ route('admin.payments.client', $payment->user) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">
                    All Payments
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Payment Details</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Amount</p>
                    <p class="text-white font-medium text-xl">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Status</p>
                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                        @if($payment->status === 'completed') bg-green-600/20 text-green-400
                        @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
                        @elseif($payment->status === 'refunded') bg-blue-600/20 text-blue-400
                        @else bg-red-600/20 text-red-400 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Method</p>
                    <p class="text-white font-medium">{{ $payment->payment_method_label }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">For</p>
                    <p class="text-white font-medium">{{ $payment->payment_for_label }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Date</p>
                    <p class="text-white font-medium">{{ $payment->payment_date->format('M d, Y') }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Reference</p>
                    <p class="text-white font-medium">{{ $payment->reference_number ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Client</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Name</p>
                    <p class="text-white font-medium">{{ $payment->user->first_name }} {{ $payment->user->last_name }}</p>
                </div>
                <div class="bg-zinc-800/50 rounded-xl p-4">
                    <p class="text-xs text-zinc-500 mb-1">Email</p>
                    <p class="text-white font-medium text-sm">{{ $payment->user->email }}</p>
                </div>
            </div>
        </div>

        @if($payment->booking)
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
            <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-4">Linked Booking</h2>
            <div class="bg-zinc-800/50 rounded-xl p-4">
                <p class="text-xs text-zinc-500 mb-1">Booking #{{ $payment->booking->id }}</p>
                <p class="text-white font-medium">{{ ucfirst($payment->booking->membership_type) }} Membership</p>
                <p class="text-zinc-400 text-sm">{{ $payment->booking->start_date->format('M d, Y') }} - {{ $payment->booking->end_date->format('M d, Y') }}</p>
            </div>
        </div>
        @endif

        @if($payment->description || $payment->notes)
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
            @if($payment->description)
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-2">Description</h2>
                <p class="text-zinc-300 text-sm">{{ $payment->description }}</p>
            </div>
            @endif
            @if($payment->notes)
            <div>
                <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-wider mb-2">Notes</h2>
                <p class="text-zinc-300 text-sm whitespace-pre-line">{{ $payment->notes }}</p>
            </div>
            @endif
        </div>
        @endif
    </div>
</x-layouts::app-main>
