@extends('backend.layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    <div class="bg-white p-6 rounded-lg shadow-md h-fit lg:col-span-2">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Edit Expense Item</h2>
        <p class="text-xs text-gray-500 mb-6">
            Update the line item. Changing the amount will automatically adjust all 3 family accounts to keep the accounting consistent.
        </p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded text-sm">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('expenses.update', $detail->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Read-only context -->
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                <label class="block text-sm font-semibold text-gray-700">Mamla Date</label>
                <input type="text" value="{{ optional($detail->expense)->mamla_date ?? '-' }}" readonly
                    class="mt-1 w-full p-2 border border-gray-200 rounded text-sm bg-gray-100 text-gray-600">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600">Expense Title</label>
                    <input type="text" name="title" value="{{ old('title', $detail->title) }}" required
                        class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600">Category / Type</label>
                    <select name="type" required class="mt-1 w-full p-2 border border-gray-300 rounded text-sm bg-white">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ (int) old('type', $detail->expense_category_id) === (int) $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600">Total Amount (Gross BDT)</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount', $detail->amount) }}" required
                    class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                <p class="text-[11px] text-gray-400 mt-1">
                    Current: {{ number_format($detail->amount, 2) }} ৳ — Per account share will update accordingly.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-lg shadow-sm hover:bg-green-700 font-semibold text-sm">
                    Update
                </button>
                <a href="{{ route('expenses.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg text-sm hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection