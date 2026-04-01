<x-layouts::app-main title="Payment Details - GymCenter">
    <!-- Back Button -->
    <a href="{{ route('client.payments') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white mb-4 sm:mb-6 transition-colors text-sm sm:text-base ml-4 sm:ml-6 lg:mx-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to My Payments
    </a>

    <!-- Header -->
    <div class="mb-6 sm:mb-8 px-4 sm:mx-6 lg:mx-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-white">Payment Receipt</h1>
        <p class="mt-1 sm:mt-2 text-zinc-400">Payment #{{ $payment->id }} - {{ $payment->payment_date->format('F d, Y') }}</p>
    </div>

    <!-- Amount & Status -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-6 sm:p-8 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8 text-center">
        <p class="text-zinc-400 text-sm mb-2">Amount Paid</p>
        <p class="text-4xl sm:text-5xl font-bold text-white mb-3">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full
            @if($payment->status === 'completed') bg-green-600/20 text-green-400
            @elseif($payment->status === 'pending') bg-yellow-600/20 text-yellow-400
            @elseif($payment->status === 'refunded') bg-blue-600/20 text-blue-400
            @else bg-red-600/20 text-red-400 @endif">
            {{ ucfirst($payment->status) }}
        </span>
    </div>

    <!-- Payment Details -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Payment Details</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Payment Method</p>
                <p class="text-white font-medium">{{ $payment->payment_method_label }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Payment For</p>
                <p class="text-white font-medium">{{ $payment->payment_for_label }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Payment Date</p>
                <p class="text-white font-medium">{{ $payment->payment_date->format('F d, Y') }}</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Reference Number</p>
                <p class="text-white font-medium">{{ $payment->reference_number ?? 'N/A' }}</p>
            </div>
            @if($payment->recordedBy)
            <div>
                <p class="text-zinc-400 text-sm">Recorded By</p>
                <p class="text-white font-medium">{{ $payment->recordedBy->first_name }} {{ $payment->recordedBy->last_name }}</p>
            </div>
            @endif
            @if($payment->gym)
            <div>
                <p class="text-zinc-400 text-sm">Gym</p>
                <p class="text-white font-medium">{{ $payment->gym->name }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Linked Booking -->
    @if($payment->booking)
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mb-4 sm:mb-6 mx-4 sm:mx-6 lg:mx-8">
        <h2 class="text-lg sm:text-xl font-semibold text-white mb-4">Linked Membership</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <p class="text-zinc-400 text-sm">Membership Type</p>
                <p class="text-white font-medium">{{ ucfirst($payment->booking->membership_type) }} Membership</p>
            </div>
            <div>
                <p class="text-zinc-400 text-sm">Period</p>
                <p class="text-white font-medium">{{ $payment->booking->start_date->format('M d, Y') }} - {{ $payment->booking->end_date->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Notes -->
    @if($payment->description || $payment->notes)
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-4 sm:p-6 mx-4 sm:mx-6 lg:mx-8">
        @if($payment->description)
        <div class="mb-4">
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-2">Description</h2>
            <p class="text-zinc-300">{{ $payment->description }}</p>
        </div>
        @endif
        @if($payment->notes)
        <div>
            <h2 class="text-lg sm:text-xl font-semibold text-white mb-2">Notes</h2>
            <p class="text-zinc-300 whitespace-pre-line">{{ $payment->notes }}</p>
        </div>
        @endif
    </div>
    @endif
</x-layouts::app-main>
