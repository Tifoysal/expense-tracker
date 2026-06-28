@extends('backend.layouts.app')

@section('title')
Bill Collection
@endsection

@section('content')<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Bill Collection Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700 mb-8">
            <div class="space-y-2">
                <p><span class="font-medium text-gray-900">Bill ID:</span> {{ $bill->id }}</p>
                <p><span class="font-medium text-gray-900">Customer Name:</span> {{ $bill->customer->full_name }}</p>
                <p><span class="font-medium text-gray-900">Order ID:</span> {{ $bill->order_id }}</p>
                <p><span class="font-medium text-gray-900">Bill Date:</span> {{ \Carbon\Carbon::parse($bill->collection_date)->format('d M Y') }}</p>
                <p><span class="font-medium text-gray-900">Payment Type:</span> {{ ucfirst($bill->payment_type) }}</p>
                <p><span class="font-medium text-gray-900">Transaction ID:</span> {{ $bill->transaction_id ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <p><span class="font-medium text-gray-900">Amount:</span> <span class="text-blue-600 font-semibold">{{ number_format($bill->amount, 2) }}</span></p>
                <p><span class="font-medium text-gray-900">Status:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $bill->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($bill->status) }}
                    </span>
                </p>
                <p><span class="font-medium text-gray-900">Employee:</span> {{ $bill->employee->name ?? '-' }}</p>
                <p><span class="font-medium text-gray-900">Narration:</span> {{ $bill->narration ?? '-' }}</p>
            </div>
        </div>

        @if ($bill->status == 'disbursed')
        <form method="POST" action="{{ route('bill.credit', $bill->id) }}" class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300">
            @csrf
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Credit this Bill</h3>

            <div class="mb-4">
                <label for="account_head_id" class="block mb-1 font-medium text-gray-700">Select Account Head</label>
                <select name="account_head_id" id="account_head_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">-- Choose an account head --</option>
                    @foreach($accountHeads as $head)
                        <option value="{{ $head->id }}">{{ $head->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    💰 Credit Amount
                </button>
            </div>
        </form>
        @elseif($bill->status == 'pending')
            <div class="mt-6 p-4 text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-lg">
                <strong>This bill is pending.</strong>
            </div>
        @else
            <div class="mt-6 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                ✅ <strong>This bill has already been credited.</strong>
            </div>
        @endif
    </div>
</div>
@endsection
