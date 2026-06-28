@extends('backend.layouts.app')

@section('content')    <div class="container mx-auto max-w-4xl mt-10">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-6">Create Transfer</h2>

            <form action="{{ route('transfer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- From Account -->
                    <div>
                        <label for="from_account" class="block mb-1 font-medium text-gray-600">From Account <span class="text-red-500">*</span></label>
                        <select name="from_account" id="from_account" class="form-select w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 text-gray-800 focus:outline-none focus:ring focus:border-indigo-300">
                            <option value="" disabled selected>Select Account</option>
                            
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}" @selected(old('from_account') == $account->id)>
                                    {{ $account->name }} - {{ $account->type }} {{$account->balance}} ({{ $account->currency }}) 
                                </option>
                            @endforeach
                        </select>
                        @error('from_account')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- To Account -->
                    <div>
                        <label for="to_account" class="block mb-1 font-medium text-gray-600">To Account <span class="text-red-500">*</span></label>
                        <select name="to_account" id="to_account" class="form-select w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 text-gray-800 focus:outline-none focus:ring focus:border-indigo-300">
                            <option value="" disabled selected>Select Account</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}" @selected(old('to_account') == $account->id)>
                                    {{ $account->name }} - {{ $account->type }}  {{$account->balance}} ({{ $account->currency }})
                                </option>
                            @endforeach
                        </select>
                        @error('to_account')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block mb-1 font-medium text-gray-600">Date <span class="text-red-500">*</span></label>
                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                            class="w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 focus:outline-none focus:ring focus:border-indigo-300">
                        @error('date')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block mb-1 font-medium text-gray-600">Amount <span class="text-red-500">*</span></label>
                        <input type="number" name="amount" id="amount" placeholder="৳0.00" value="{{ old('amount') }}"
                            class="w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 focus:outline-none focus:ring focus:border-indigo-300">
                        @error('amount')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block mb-1 font-medium text-gray-600">Payment Method <span class="text-red-500">*</span></label>
                        <select name="payment_method" id="payment_method"
                            class="form-select w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 text-gray-800 focus:outline-none focus:ring focus:border-indigo-300">
                            <option value="" disabled selected>Select Option</option>
                            <option value="bank" @selected(old('payment_method') == 'bank')>Bank</option>
                            <option value="cash" @selected(old('payment_method') == 'cash')>Cash</option>
                            <option value="mfs" @selected(old('payment_method') == 'mfs')>MFS</option>
                        </select>
                        @error('payment_method')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Reference -->
                    <div>
                        <label for="reference" class="block mb-1 font-medium text-gray-600">Reference</label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference') }}" placeholder="Reference"
                            class="w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 focus:outline-none focus:ring focus:border-indigo-300">
                    </div>

                    <!-- Attachment -->
                    <div>
                        <label for="attachment" class="block mb-1 font-medium text-gray-600">Attachment</label>
                        <input type="file" name="attachment" id="attachment"
                            class="w-full h-10 rounded-md border border-gray-300 bg-gray-50 px-3 focus:outline-none focus:ring focus:border-indigo-300">
                        @error('attachment')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block mb-1 font-medium text-gray-600">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 focus:outline-none focus:ring focus:border-indigo-300"
                        placeholder="Write details about the transfer here...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('transfer.index') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        function updateAccountOptions() {
            const fromSelected = $('#from_account').val();
            const toSelected = $('#to_account').val();

            $('#to_account option').each(function () {
                const val = $(this).val();
                if (val && val === fromSelected) {
                    $(this).prop('disabled', true).hide();
                } else {
                    $(this).prop('disabled', false).show();
                }
            });

            $('#from_account option').each(function () {
                const val = $(this).val();
                if (val && val === toSelected) {
                    $(this).prop('disabled', true).hide();
                } else {
                    $(this).prop('disabled', false).show();
                }
            });
        }

        $('#from_account, #to_account').on('change', updateAccountOptions);

        // Initial check in case of old() or pre-filled values
        updateAccountOptions();
    });
</script>

@endsection
