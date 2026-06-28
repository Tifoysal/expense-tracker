@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Update Expense</h2>
                <p class="text-gray-500 mt-3 text-lg">Edit the expense details below</p>
            </div>

            <form action="{{ route('expense.update', $expense->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <input type="hidden" name="employee_id" id="employee_id" value=" {{ $expense->employee_id }}">
                    <div>
                        <label for="employee_id" class="block text-base font-medium text-gray-700">Employee Name </label>
                        <input type="text" id="employee_id" value="{{ old('employee_id', $expense->employee->name) }}" readonly
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400"
                               placeholder="0.00">
                        @error('employee_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-base font-medium text-gray-700">Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="date" id="date" value="{{ old('date', $expense->date) }}"
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400">
                        @error('date')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-base font-medium text-gray-700">Payment Method <span class="text-red-500">*</span></label>
                        <select name="payment_method" id="payment_method"
                                class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400">
                            <option disabled>Select Option</option>
                            <option value="bank" {{ old('payment_method', $expense->payment_method) == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="cash" {{ old('payment_method', $expense->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                        @error('payment_method')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account -->
                    <div>
                        <label for="account_no" class="block text-base font-medium text-gray-700">Account Name <span class="text-red-500">*</span></label>
                        <select name="account_no" id="account_no"
                                class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400">
                            <option disabled>Select Account Name</option>
                            @foreach ($account as $data)
                                <option value="{{ $data->id }}" {{ old('account_no', $expense->banking_account_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('account_no')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Amount (Disabled as in original) -->
                    <div>
                        <label for="amount" class="block text-base font-medium text-gray-700">Amount <span class="text-red-500">*</span></label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}"
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400"
                               placeholder="0.00">
                        @error('amount')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Transaction No -->
                    <div>
                        <label for="tran_no" class="block text-base font-medium text-gray-700">Transaction No <span class="text-red-500">*</span></label>
                        <input type="number" name="tran_no" id="tran_no" value="{{ old('tran_no', $expense->tran_no) }}"
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400"
                               placeholder="Transaction No">
                        @error('tran_no')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-base font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id"
                                class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400" required>
                            <option disabled value="">Select</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $expense->expense_category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @foreach ($cat->childrenCategories as $childCategory)
                                    @include('backend.expenses.child_category_edit_expense', [
                                        'child_category' => $childCategory,
                                        'hi_pen' => $hi_pen,
                                    ])
                                @endforeach
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Reference -->
                    <div>
                        <label for="reference" class="block text-base font-medium text-gray-700">Reference No</label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference', $expense->reference) }}"
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400"
                               placeholder="Reference">
                        @error('reference')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tax -->
                    <div>
                        <label for="tax" class="block text-base font-medium text-gray-700">Tax</label>
                        <select name="tax" id="tax"
                                class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400">
                            <option disabled>Select Tax</option>
                            @foreach ($tax as $data)
                                <option value="{{ $data->id }}" {{ old('tax', $expense->tax_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tax')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Attachment -->
                    <div>
                        <label for="attachment" class="block text-base font-medium text-gray-700">Attachment</label>
                        <input type="file" name="attachment" id="attachment"
                               class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400">
                        @error('attachment')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Narration (Full Width) -->
                <div>
                    <label for="narration" class="block text-base font-medium text-gray-700">Narration</label>
                    <textarea name="narration" id="narration"
                              class="mt-2 block w-full rounded-lg border border-gray-200 bg-gray-50 py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-400"
                              rows="3" placeholder="Narration">{{ old('narration', $expense->narration) }}</textarea>
                    @error('narration')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('expense.index') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
