@extends('backend.layouts.app')
@section('title', 'Customer Order History')

@section('content')<div class="max-w-7xl mx-auto px-6 py-10 bg-white shadow-lg rounded-xl">
    
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 border-b pb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Order History Details</h2>
            <div class="mt-2 text-gray-600">
                <p><span class="font-medium text-gray-900">Customer:</span> {{ $customer->name ?? 'N/A' }}</p>
                {{-- প্রথম অর্ডার থেকে রিসিভারের তথ্য নেওয়া হচ্ছে --}}
                <p><span class="font-medium text-gray-900">Receiver:</span> {{ $orders->first()->receiver_name ?? 'N/A' }} ({{ $orders->first()->receiver_phone ?? '' }})</p>
                <p><span class="font-medium text-gray-900">Period:</span> 
                    {{ \Carbon\Carbon::parse($fromDate)->format('d M, Y') }} - {{ \Carbon\Carbon::parse($toDate)->format('d M, Y') }}
                </p>
            </div>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md border transition">
                ← Back to Summary
            </a>
        </div>
    </div>

    {{-- Order Detail Table --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase">Order Details</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase">Payment Info</th>
                    <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase text-center">Status</th>
                    <th class="px-4 py-3 text-right font-bold text-gray-700 uppercase">Total Amount</th>
                    <th class="px-4 py-3 text-right font-bold text-gray-700 uppercase text-indigo-600">Commission</th>
                    <th class="px-4 py-3 text-right font-bold text-gray-700 uppercase">Net Payable</th>
                    <th class="px-4 py-3 text-right font-bold text-gray-700 uppercase text-red-600">Due</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Initialize Totals --}}
                @php
                    $sumTotal = 0;
                    $sumComm = 0;
                    $sumNet = 0;
                    $sumDue = 0;
                @endphp

                @forelse($orders as $order)
                    @php
                        $sumTotal += $order->total_amount;
                        $sumComm += $order->commission_amount;
                        $sumNet += $order->payable_total;
                        $sumDue += $order->due;
                    @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">
                            <div class="font-bold text-gray-900">{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y h:i A') }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $order->order_type }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="capitalize">{{ $order->payment_method }}</div>
                            <div class="text-xs font-semibold {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-orange-500' }}">
                                {{ strtoupper($order->payment_status) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-gray-100 text-gray-600 border uppercase">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right text-gray-900">
                            {{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right text-indigo-600">
                            {{ number_format($order->commission_amount, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right font-semibold text-gray-900">
                            {{ number_format($order->payable_total, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="{{ $order->due > 0 ? 'text-red-600 font-bold' : 'text-gray-400' }}">
                                {{ number_format($order->due, 2) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-500 italic">
                            No detailed orders found for the selected timeframe.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            {{-- Footer Summary --}}
            @if($orders->count() > 0)
                <tfoot class="bg-gray-800 text-white font-bold border-t-2 border-gray-900">
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-xs uppercase tracking-widest">Grand Total ({{ $orders->count() }} Orders)</td>
                        <td class="px-4 py-4 text-right border-l border-gray-700">
                            {{ number_format($sumTotal, 2) }}
                        </td>
                        <td class="px-4 py-4 text-right border-l border-gray-700 text-indigo-300">
                            {{ number_format($sumComm, 2) }}
                        </td>
                        <td class="px-4 py-4 text-right border-l border-gray-700 text-green-300">
                            {{ number_format($sumNet, 2) }}
                        </td>
                        <td class="px-4 py-4 text-right border-l border-gray-700 text-red-300">
                            {{ number_format($sumDue, 2) }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>

    {{-- Export / Print Action --}}
    <div class="mt-6 flex justify-end gap-3">
        <button onclick="window.print()" class="px-5 py-2 bg-indigo-600 text-white rounded shadow-md hover:bg-indigo-700 transition text-sm">
            Print Order Details
        </button>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        .max-w-7xl, .max-w-7xl * { visibility: visible; }
        .max-w-7xl { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; }
        button, a { display: none !important; }
    }
</style>
@endsection