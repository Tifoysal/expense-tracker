@extends('backend.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <form method="GET" action="{{ route('expenses.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Filter by Mamla Date</label>
                <input type="date" name="mamla_date" value="{{ request('mamla_date') }}" class="w-full p-2 border border-gray-300 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Filter by Type</label>
                <select name="type" class="w-full p-2 border border-gray-300 rounded text-sm">
                    <option value="">All Categories</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 bg-gray-800 text-white p-2 rounded text-sm font-medium hover:bg-gray-900 shadow">Apply Filter</button>
                @if(request()->anyFilled(['mamla_date', 'type']))
                    <a href="{{ route('expenses.index') }}" class="bg-gray-200 text-gray-700 p-2 rounded text-sm text-center hover:bg-gray-300">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">All Expenses Ledger</h2>
            <a href="{{ route('expenses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm shadow hover:bg-blue-700">Add New Entry</a>
        </div>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold border-b border-gray-200">
                    <th class="px-6 py-3">Mamla Date</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Category</th>
                   
                    <th class="px-6 py-3 text-right">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($expenses as $detail)
                <tr>
                    <td class="px-6 py-4 font-semibold">{{ $detail->expense->mamla_date }}</td>
                    <td class="px-6 py-4">{{ $detail->title }}</td>
                    <td class="px-6 py-4"><span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs">{{ $detail->expenseCategory->name }}</span></td>
                    <td class="px-6 py-4 text-right font-bold text-red-600">{{ number_format($detail->amount, 2) }} BDT</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">No matching expense statements located.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection