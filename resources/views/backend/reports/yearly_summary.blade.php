@extends('backend.layouts.app')
@section('title', 'Yearly Closing Summary Report')

@section('content')<div class="max-w-7xl mx-auto px-6 py-10 bg-white shadow-lg rounded-xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Yearly Closing Summary Report</h2>

    {{-- Filter Form --}}
    <form action="{{ route('reports.yearly.summary') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        {{-- MO Dropdown --}}
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Marketing Officer</label>
            <select name="employee_id" id="employee_id" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Employee (MO)</option>
                @foreach($employees as $mo)
                <option value="{{ $mo->id }}" {{ request()->employee_id == $mo->id ? 'selected' : '' }}>
                    {{ $mo->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- From Date --}}
            <div>
                <label for="from_date" class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date" name="from_date" id="from_date"
                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    max="{{ now()->format('Y-m-d') }}" value="{{ isset($fromDate) && $fromDate ? \Carbon\Carbon::parse($fromDate)->format('Y-m-d') : '' }}">
            </div>

            {{-- To Date --}}
            <div>
                <label for="to_date" class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date" name="to_date" id="to_date"
                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    max="{{ now()->format('Y-m-d') }}" value="{{ isset($toDate) && $toDate ? \Carbon\Carbon::parse($toDate)->format('Y-m-d') : '' }}">
            </div>
        </div>

        {{-- Error Message --}}
        <p id="date-error" class="text-red-500 text-xs mt-2 hidden">To Date cannot be earlier than From Date.</p>

        {{-- Submit --}}
        <div class="flex items-end">
            <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                Generate Report
            </button>
        </div>
    </form>

    {{-- Validation --}}
    @if($errors->any())
    <div class="mb-4 text-red-600 font-semibold">
        @foreach($errors->all() as $error)
        <div>- {{ $error }}</div>
        @endforeach
    </div>
    @endif

    {{-- Report Heading --}}
    @if(isset($summaryData))
    <div class="text-center text-xl font-bold mb-6">
        {{ $selectedMO->name ?? 'N/A' }} Yearly Closing Summary Report - {{ isset($fromDate) && $fromDate ? \Carbon\Carbon::parse($fromDate)->format('Y-m-d') : '' }} to {{ isset($toDate) && $toDate ? \Carbon\Carbon::parse($toDate)->format('Y-m-d') : '' }}
    </div>

    {{-- Report Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-800 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">Mobile No</th>
                    <th class="px-4 py-2 border">Customer Name</th>
                    <th class="px-4 py-2 border">Business Name & Address</th>
                    <th class="px-4 py-2 border">TP Amount</th>
                    <th class="px-4 py-2 border">Commission</th>
                    <th class="px-4 py-2 border">Net Amount</th>
                    <th class="px-4 py-2 border">Due</th>
                </tr>
            </thead>
            <tbody>
                {{-- Initialize Total Variables --}}
                @php
                $totalTP = 0;
                $totalCommission = 0;
                $totalNet = 0;
                $totalDue = 0;
                @endphp

                @forelse($summaryData as $item)
                {{-- Summing up the values --}}
                @php
                $totalTP += $item->tp_amount;
                $totalCommission += $item->commission;
                $totalNet += $item->net_amount;
                $totalDue += $item->due_amount;
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $item->mobile }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('reports.customer.invoices', [
            'customer_id' => $item->customer_id, 
            'from_date' => request('from_date'), 
            'to_date' => request('to_date')
        ]) }}"
                            class="text-indigo-600 hover:text-indigo-900 font-semibold underline">
                            {{ $item->customer_name }}
                        </a>
                    </td>
                    <td class="px-4 py-2 border">
                        <strong>{{ $item->business_name }}</strong><br>
                        <span class="text-xs text-gray-600">{{ $item->address }}</span>
                    </td>
                    <td class="px-4 py-2 border text-right">{{ number_format($item->tp_amount, 2) }}</td>
                    <td class="px-4 py-2 border text-right">{{ number_format($item->commission, 2) }}</td>
                    <td class="px-4 py-2 border text-right">{{ number_format($item->net_amount, 2) }}</td>
                    <td class="px-4 py-2 border text-right font-semibold {{ $item->due_amount > 0 ? 'text-red-600' : '' }}">
                        {{ number_format($item->due_amount, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-500">No data found for the selected criteria.</td>
                </tr>
                @endforelse
            </tbody>

            {{-- Footer with Grand Totals --}}
            @if(count($summaryData) > 0)
            <tfoot class="bg-gray-800 text-white font-bold">
                <tr>
                    <td colspan="3" class="px-4 py-3 border text-center uppercase tracking-wider">Grand Total</td>
                    <td class="px-4 py-3 border text-right">{{ number_format($totalTP, 2) }}</td>
                    <td class="px-4 py-3 border text-right">{{ number_format($totalCommission, 2) }}</td>
                    <td class="px-4 py-3 border text-right">{{ number_format($totalNet, 2) }}</td>
                    <td class="px-4 py-3 border text-right">{{ number_format($totalDue, 2) }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    {{-- Print/Export Button (Optional) --}}
    <div class="mt-6 flex justify-end">
        <button onclick="window.print()" class="px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-900 transition">
            Print Report
        </button>
    </div>
    @endif
</div>

<script>
    // Simple validation for Date Range
    document.querySelector('form').addEventListener('submit', function(e) {
        const from = document.getElementById('from_date').value;
        const to = document.getElementById('to_date').value;
        const error = document.getElementById('date-error');

        if (from && to && new Date(from) > new Date(to)) {
            e.preventDefault();
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    });
</script>
@endsection