@extends('backend.layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    
<div class="bg-white p-6 rounded-lg shadow-md h-fit">
    <h2 class="text-lg font-bold text-gray-800 mb-2">Post Mamla Expenses</h2>
    <p class="text-xs text-gray-500 mb-6">Group multiple cost line items under a single court date. Each item will be split 3-ways.</p>
    
    <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <label class="block text-sm font-semibold text-gray-700">Mamla Action Date</label>
            <input type="date" name="mamla_date" value="{{ date('Y-m-d') }}" required 
                class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
        </div>


         
        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <label class="block text-sm font-semibold text-gray-700">Remarks</label>
            <input type="text" name="expenses_remarks" value="" required  placeholder="mamla remarks"
                class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
        </div>

        <div>
                        <label class="block text-xs font-medium text-gray-600">Representative Handler</label>
                        <input type="text" name="expenses[0][representative]" placeholder="Who paid" required 
                            class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                    </div>

        <div id="expense-rows-container" class="space-y-4">
            <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider">Expense Line Items</h3>
            
            <div class="expense-row p-4 border border-gray-200 rounded-lg relative space-y-3 bg-white shadow-xs">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Expense Title</label>
                        <input type="text" name="expenses[0][title]" placeholder="e.g., Photocopying" required 
                            class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Category / Type</label>
                        <select name="expenses[0][type]" required class="mt-1 w-full p-2 border border-gray-300 rounded text-sm bg-white">
                            <option value="">Select Category...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Total Amount (Gross BDT)</label>
                        <input type="number" step="0.01" name="expenses[0][total_amount]" placeholder="Gross ৳" required 
                            class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center pt-2">
            <button type="button" id="add-row-btn" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                <span>+ Add Another Expense Item</span>
            </button>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg shadow-sm hover:bg-green-700 font-semibold transition text-sm">
            Create
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = 1;
        const container = document.getElementById('expense-rows-container');
        const addBtn = document.getElementById('add-row-btn');

        addBtn.addEventListener('click', function () {
            const newRow = document.createElement('div');
            newRow.className = 'expense-row p-4 border border-gray-200 rounded-lg relative space-y-3 bg-white shadow-xs';
            newRow.innerHTML = `
                <div class="flex justify-between items-center border-b border-gray-100 pb-1">
                    <span class="text-xs font-semibold text-slate-400">Item #${rowIndex + 1}</span>
                    <button type="button" class="remove-row-btn text-xs text-red-500 hover:text-red-700 font-medium">Remove</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Expense Title</label>
                        <input type="text" name="expenses[${rowIndex}][title]" placeholder="e.g., Photocopying" required class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Category / Type</label>
                        <select name="expenses[${rowIndex}][type]" required class="mt-1 w-full p-2 border border-gray-300 rounded text-sm bg-white">
                            <option value="">Select Category...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Total Amount (Gross BDT)</label>
                        <input type="number" step="0.01" name="expenses[${rowIndex}][total_amount]" placeholder="Gross ৳" required class="mt-1 w-full p-2 border border-gray-300 rounded text-sm">
                    </div>
                   
                </div>
            `;
            container.appendChild(newRow);
            rowIndex++;
        });

        // Event delegation to capture click on dynamically added "Remove" buttons
        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row-btn')) {
                e.target.closest('.expense-row').remove();
            }
        });
    });
</script>


</div>
@endsection