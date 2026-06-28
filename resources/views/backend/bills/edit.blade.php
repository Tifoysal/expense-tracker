@extends('backend.layouts.app')

@section('title')
Edit Bill Date
@endsection

@section('content')<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Bill Date</h2>

        <form method="POST" action="{{ route('bill.update', $bill->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700 mb-8">
                <div class="space-y-2">
                    <p><span class="font-medium text-gray-900">Bill ID:</span> {{ $bill->id }}</p>
                    <p><span class="font-medium text-gray-900">Customer Name:</span> {{ $bill->customer->full_name }}</p>
                    <p><span class="font-medium text-gray-900">Order ID:</span> {{ $bill->order_id }}</p>

                    <!-- Editable Bill Date -->
                    <div>
                        <label class="font-medium text-gray-900">Bill Date</label>
                        <input 
                            type="date" 
                            name="collection_date"
                            value="{{ \Carbon\Carbon::parse($bill->collection_date)->format('Y-m-d') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1"
                            required
                        >
                    </div>

                    <p><span class="font-medium text-gray-900">Payment Type:</span> {{ ucfirst($bill->payment_type) }}</p>
                    <p><span class="font-medium text-gray-900">Transaction ID:</span> {{ $bill->transaction_id ?? '-' }}</p>
                </div>

                <div class="space-y-2">
                    <p><span class="font-medium text-gray-900">Amount:</span> 
                        <span class="text-blue-600 font-semibold">{{ number_format($bill->amount, 2) }}</span>
                    </p>

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

            <div class="flex gap-3">
                <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    Update Bill Date
                </button>

                <a href="{{ url()->previous()  }}"
                    class="inline-flex items-center px-5 py-2 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection