@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Update Account</h2>
                <p class="text-gray-500 mt-3 text-lg">Edit the details of this banking account.</p>
            </div>
            <form action="{{ route('banking.account.update', $account->id) }}" method="post" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="type" class="block text-base font-medium text-gray-700">Account Type <span class="text-red-500">*</span></label>
                        <select name="type" id="type" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" required>
                            <option value="" disabled>Select Option</option>
                            <option value="bank" @if($account->type == 'bank') selected @endif>Bank</option>
                            <option value="cash" @if($account->type == 'cash') selected @endif>Cash</option>
                            <option value="mfs" @if($account->type == 'mfs') selected @endif>MFS</option>
                        </select>
                        @error('type')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ $account->name }}" placeholder="Name" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="account_no" class="block text-base font-medium text-gray-700">Account Number</label>
                        <input type="number" name="account_no" id="account_no" value="{{ $account->account_no }}" placeholder="Account No." class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                        @error('account_no')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="currency" class="block text-base font-medium text-gray-700">Currency</label>
                        <input type="text" name="currency" id="currency" value="{{ $account->currency }}" placeholder="Currency" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                        @error('currency')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="starting_balance" class="block text-base font-medium text-gray-700">Starting Balance <span class="text-red-500">*</span></label>
                        <input type="number" name="starting_balance" id="starting_balance" value="{{ $account->starting_balance }}" placeholder="0.00" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" required>
                        @error('starting_balance')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-data="{ isYes: {{ $account->default_account == 1 ? 'true' : 'false' }} }">
                        <label for="default_account" class="block text-base font-medium text-gray-700">Default Account</label>
                        <div class="flex items-center mt-4">
                            <button type="button"
                                @click="isYes = !isYes"
                                :class="isYes ? 'bg-green-500' : 'bg-red-500'"
                                class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold focus:outline-none transition-colors duration-200 text-sm"
                                x-text="isYes ? 'Yes' : 'No'"></button>
                            <input type="hidden" name="default_account" x-bind:value="isYes ? 1 : 0">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="bank_name" class="block text-base font-medium text-gray-700">Bank Name</label>
                        <input type="text" name="bank_name" id="bank_name" value="{{ $account->bank_name }}" placeholder="Bank Name" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                    </div>
                    <div>
                        <label for="bank_phone" class="block text-base font-medium text-gray-700">Bank Phone</label>
                        <input type="text" name="bank_phone" id="bank_phone" value="{{ $account->bank_phone }}" placeholder="Bank Phone" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                        @error('bank_phone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="bank_address" class="block text-base font-medium text-gray-700">Bank Address</label>
                    <input type="text" name="bank_address" id="bank_address" value="{{ $account->bank_address }}" placeholder="Bank Address" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                </div>
                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('banking.account.index') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>




@endsection

@push('scripts')
<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs" defer></script>
@endpush