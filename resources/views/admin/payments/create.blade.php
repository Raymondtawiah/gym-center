<x-layouts::app-main title="Record Payment - GymCenter">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Payments
        </a>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Record Payment</h1>
            <p class="text-zinc-400 mt-1">Record a new payment from a client</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.payments.store') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-zinc-400 mb-2">Client <span class="text-red-400">*</span></label>
                            <select name="user_id" id="user_id" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Select a client...</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ ($selectedUserId ?? old('user_id')) == $client->id ? 'selected' : '' }}>{{ $client->first_name }} {{ $client->last_name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="amount" class="block text-sm font-medium text-zinc-400 mb-2">Amount <span class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" required placeholder="0.00" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            @error('amount')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-zinc-400 mb-2">Currency</label>
                            <select name="currency" id="currency" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="GHS" {{ old('currency', 'GHS') == 'GHS' ? 'selected' : '' }}>GHS - Ghana Cedis</option>
                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-zinc-400 mb-2">Payment Method <span class="text-red-400">*</span></label>
                            <select name="payment_method" id="payment_method" required onchange="toggleReferenceField()" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money (Momo)</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                                <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_for" class="block text-sm font-medium text-zinc-400 mb-2">Payment For <span class="text-red-400">*</span></label>
                            <select name="payment_for" id="payment_for" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="membership" {{ old('payment_for') == 'membership' ? 'selected' : '' }}>Membership</option>
                                <option value="class" {{ old('payment_for') == 'class' ? 'selected' : '' }}>Class</option>
                                <option value="personal_training" {{ old('payment_for') == 'personal_training' ? 'selected' : '' }}>Personal Training</option>
                                <option value="other" {{ old('payment_for') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-zinc-400 mb-2">Status <span class="text-red-400">*</span></label>
                            <select name="status" id="status" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="completed" {{ old('status', 'completed') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_date" class="block text-sm font-medium text-zinc-400 mb-2">Payment Date <span class="text-red-400">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div id="reference_field" style="display: none;">
                            <label for="reference_number" class="block text-sm font-medium text-zinc-400 mb-2">Transaction Reference <span class="text-red-400">*</span></label>
                            <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number') }}" placeholder="Momo/Bank/Card transaction ID" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <p class="mt-1 text-xs text-zinc-500">Required for Mobile Money, Bank Transfer, and Card payments</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-zinc-400 mb-2">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description') }}" placeholder="Brief description" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-zinc-400 mb-2">Notes</label>
                            <textarea name="notes" id="notes" rows="3" placeholder="Additional notes..." class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('admin.payments.index') }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-xl transition-colors">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">Record Payment</button>
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
