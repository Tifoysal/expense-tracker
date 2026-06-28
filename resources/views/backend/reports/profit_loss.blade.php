@extends('backend.layouts.app')

@section('title')
Report (Loss/Profit)
@endsection

@section('content')@php
$totalSale = 0;
$totalProfit = 0;
$totalLoss = 0;
@endphp

<div class="flex flex-col container px-8">
    <div class="flex justify-between items-center mb-4">
        <!-- Left side: Filter form -->
        <form method="GET" class="flex gap-4 items-center">
            <div>
                <label for="month">Month:</label>
                <input type="month" name="month" id="month" value="{{ request('month') }}" class="border rounded px-2 py-1">
            </div>
            <div>
                <!-- <label for="company">Company:</label>
            <select name="company" id="company" class="border rounded px-2 py-1">
                <option value="">All</option>
                <option value="gph" {{ request('company') == 'gph' ? 'selected' : '' }}>GPH</option>
                <option value="kaicom" {{ request('company') == 'kaicom' ? 'selected' : '' }}>Kaicom</option>
            </select> -->
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <!-- Right side: Print button -->
        <button onclick="printReport()" class="bg-green-600 text-white px-4 py-2 rounded">
            🖨️ Print
        </button>
    </div>


    <div id="print-area" class="bg-white p-6 shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Profit/Loss Report – {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h2>
            <!-- <h3 class="text-md font-medium">{{ $settings->company_name }}</h3> -->
        </div>

        @php
        $totalSale = 0;
        $totalProfit = 0;
        $totalLoss = 0;
        @endphp

        @foreach($orderDetails as $detail)
        @php
        $cost = $detail->cost_price ?? 0;
        $sale = $detail->payable_subtotal ?? 0;
        $qty = $detail->quantity ?? 1;
        $diff = ($sale - ($cost * $qty));

        $totalSale += $sale;
        if ($diff >= 0) {
        $totalProfit += $diff;
        } else {
        $totalLoss += abs($diff);
        }
        @endphp
        @endforeach

        <div class="flex justify-end gap-10 mb-4 print:flex" style="justify-content: flex-end; gap: 40px; margin-bottom: 20px;">
            <div><strong>Total Sale:</strong> {{ number_format($totalSale, 2) }}</div>
            <div><strong>Total Profit:</strong> <span class="text-green-600">{{ number_format($totalProfit, 2) }}</span></div>
            <div><strong>Total Loss:</strong> <span class="text-red-600">{{ number_format($totalLoss, 2) }}</span></div>
        </div>


        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Order ID</th>
                    <th class="p-2 border">Customer</th>
                    <th class="p-2 border">Employee</th>
                    <th class="p-2 border">Product (Variant)</th>
                    <th class="p-2 border">Qty</th>
                    <th class="p-2 border">Sale Total</th>
                    <th class="p-2 border">Profit/Loss</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $detail)
                @php
                $sale = $detail->payable_subtotal ?? 0;
                $qty = $detail->quantity ?? 1;
                $cost = $detail->cost_price * $qty;

                $diff = ($sale - $cost);
                $isProfit = $diff >= 0;
                @endphp
                <tr>
                    <td class="p-2 border">{{ $detail->order->created_at->format('Y-m-d') }}</td>
                    <td class="p-2 border">{{ $detail->order->id }}</td>
                    <td class="p-2 border">{{ $detail->order->customer->name ?? '-' }}</td>
                    <td class="p-2 border">{{ $detail->order->user->name ?? '-' }}</td>
                    <td class="p-2 border">
                        {{ $detail->product->name }}
                        @if($detail->variation)
                        - {{ $detail->variation->attribute_value }}
                        @endif
                        @if ($detail->is_gift)
                                        <span
                                            class="text-xs text-white bg-green-500 px-2 py-0.5 rounded ml-1">bonus</span>
                                        @endif
                    </td>
                    <td class="p-2 border text-center">{{ $qty }}</td>
                    <td class="p-2 border text-center">{{ $sale }}</td>
                    <td class="p-2 border text-right {{ $isProfit ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($diff, 2) }} {!! $isProfit ? '&#9650;' : '&#9660;' !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    function printReport() {
        const content = document.getElementById('print-area').innerHTML;
        const logoUrl = "{{ asset($settings->logo) }}";
        // const companyName = "{{ $settings->company_name }}";
        // const month = "{{ \Carbon\Carbon::parse($month)->format('F Y') }}";

        const myWindow = window.open('', '', 'width=1000,height=700');
        myWindow.document.write('<html><head><title>Profit/Loss Report</title>');
        myWindow.document.write(`
        <style>
            body { font-family: sans-serif; padding: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background: #f0f0f0; }
            .header { text-align: center; margin-bottom: 20px; }
            .logo { height: 60px; margin-bottom: 10px; }
        </style>
    `);
        myWindow.document.write('</head><body>');
        myWindow.document.write(`
        <div class="header">
            <img src="${logoUrl}" alt="Logo" class="logo"><br>
           
            <hr>
        </div>
    `);
        myWindow.document.write(content);
        myWindow.document.write('</body></html>');
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }
</script>
@endsection