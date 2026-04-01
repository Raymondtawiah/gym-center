<x-layouts::app-main title="Edit Payment - GymCenter">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.payments.show', $payment) }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Payment
        </a>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Edit Payment #{{ $payment->id }}</h1>
            <p class="text-zinc-400 mt-1">{{ $payment->user->first_name }} {{ $payment->user->last_name }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="amount" class="block text-sm font-medium text-zinc-400 mb-2">Amount <span class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-zinc-400 mb-2">Currency</label>
                            <select name="currency" id="currency" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="GHS" {{ old('currency', $payment->currency) == 'GHS' ? 'selected' : '' }}>GHS - Ghana Cedis</option>
                                <option value="USD" {{ old('currency', $payment->currency) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                <option value="EUR" {{ old('currency', $payment->currency) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                <option value="GBP" {{ old('currency', $payment->currency) == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-zinc-400 mb-2">Method <span class="text-red-400">*</span></label>
                            <select name="payment_method" id="payment_method" required onchange="toggleReferenceField()" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @foreach(['cash','mobile_money','bank_transfer','card','other'] as $m)
                                    <option value="{{ $m }}" {{ $payment->payment_method == $m ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $m)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="payment_for" class="block text-sm font-medium text-zinc-400 mb-2">For <span class="text-red-400">*</span></label>
                            <select name="payment_for" id="payment_for" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @foreach(['membership','class','personal_training','other'] as $f)
                                    <option value="{{ $f }}" {{ $payment->payment_for == $f ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $f)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-zinc-400 mb-2">Status <span class="text-red-400">*</span></label>
                            <select name="status" id="status" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                @foreach(['completed','pending','failed','refunded'] as $s)
                                    <option value="{{ $s }}" {{ $payment->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="payment_date" class="block text-sm font-medium text-zinc-400 mb-2">Date <span class="text-red-400">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div id="reference_field" @if(!in_array($payment->payment_method, ['mobile_money', 'bank_transfer', 'card'])) style="display: none;" @endif>
                            <label for="reference_number" class="block text-sm font-medium text-zinc-400 mb-2">Transaction Reference <span class="text-red-400">*</span></label>
                            <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $payment->reference_number) }}" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <p class="mt-1 text-xs text-zinc-500">Required for Mobile Money, Bank Transfer, and Card payments</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-zinc-400 mb-2">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $payment->description) }}" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-zinc-400 mb-2">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('notes', $payment->notes) }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('admin.payments.show', $payment) }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleReferenceField() {
            const method = document.getElementById('payment_method').value;
            const refField = document.getElementById('reference_field');
            const refInput = document.getElementById('reference_number');
            const needsReference = ['mobile_money', 'bank_transfer', 'card'];

            if (needsReference.includes(method)) {
                refField.style.display = 'block';
                refInput.required = true;
            } else {
                refField.style.display = 'none';
                refInput.required = false;
                refInput.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', toggleReferenceField);
    </script>
</x-layouts::app-main>
