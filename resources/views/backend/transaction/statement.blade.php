@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Transactions Statement</h1>

            <form method="GET" action="{{ route('transaction.statement') }}" class="space-y-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="bankingAccountName" class="block text-base font-medium text-gray-700">Account Head</label>
                        <select id="bankingAccountName" name="bankingAccountName" required
                            class="mt-2 block w-full rounded-lg border border-gray-200 bg-green-50 text-base py-2 px-4 shadow-sm">
                            <option value="" disabled {{ !request('bankingAccountName') ? 'selected' : '' }}>Select Account</option>
                            @foreach ($bankingAccounts as $account)
                            <option value="{{ $account->name }}"
                                {{ request('bankingAccountName') == $account->name ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="month" class="block text-base font-medium text-gray-700">Month</label>
                        <select id="month" name="month"
                            class="mt-2 block w-full rounded-lg border border-gray-200 bg-green-50 text-base py-2 px-4 shadow-sm">
                            @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="year" class="block text-base font-medium text-gray-700">Year</label>
                        <select id="year" name="year"
                            class="mt-2 block w-full rounded-lg border border-gray-200 bg-green-50 text-base py-2 px-4 shadow-sm">
                            @foreach(range(date('Y'), date('Y') - 10) as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="inline-block rounded-lg bg-indigo-600 px-6 py-2 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">
                        Generate Statement
                    </button>

                    <button onclick="printDiv('invoiceContent')"
                        class="inline-block rounded-lg bg-green-600 px-6 py-2 text-white font-semibold hover:bg-green-700 transition shadow text-sm">
                        Print
                    </button>
                </div>

            </form>


            <hr class="my-8 border-gray-300">

            <div id="invoiceContent" class="overflow-x-auto">

                {{-- Report Header - visible only in print --}}
                <div id="print-header" style="">
                    <div class="flex justify-between items-center mb-6">
                        <img src="{{ $settings->logo }}" alt="Logo" style="height: 50px;">
                        <div>
                            <h2 class="text-xl font-bold">Transaction Report</h2>
                            <p>{{ \Carbon\Carbon::createFromDate($year, $month)->format('F Y') }}</p>
                        </div>
                    </div>
                </div>



                {{-- Transaction Table --}}
                <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">TRN. Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Account Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Credit</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Debit</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                        $closingBalance = 0;
                        $totalDebits = 0;
                        $totalCredits = 0;
                        $debitTransactionCount = 0;
                        $creditTransactionCount = 0;
                        @endphp

                        @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $transaction->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $transaction->account->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">
                                {{ $transaction->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">
                                {{ $transaction->type == 'credit' ? number_format($transaction->amount, 2) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-semibold">
                                {{ $transaction->type == 'debit' ? number_format($transaction->amount, 2) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                {{ number_format($transaction->after_balance, 2) }}
                            </td>
                        </tr>

                        @php
                        $closingBalance = $transaction->after_balance;
                        if ($transaction->type == 'debit') {
                        $totalDebits += $transaction->amount;
                        $debitTransactionCount++;
                        } elseif ($transaction->type == 'credit') {
                        $totalCredits += $transaction->amount;
                        $creditTransactionCount++;
                        }
                        @endphp
                        @endforeach

                        {{-- Closing Balance Row --}}
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="5" class="px-6 py-3 text-right">Closing Balance:</td>
                            <td class="px-6 py-3">{{ number_format($closingBalance, 2) }} BDT</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Summary --}}
                <div class="mt-8 flex flex-col items-center text-gray-700 font-semibold space-y-2">
                    <div>
                        Opening Balance: {{ $transactions->first()?->account->starting_balance ?? 0 }} BDT
                    </div>
                    <div>
                        Total Debits: {{ number_format($totalDebits, 2) }} BDT (Count: {{ $debitTransactionCount }})
                    </div>
                    <div>
                        Total Credits: {{ number_format($totalCredits, 2) }} BDT (Count: {{ $creditTransactionCount }})
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>

@section('scripts')
<script>
    function printDiv(divId) {
        const printContents = document.getElementById(divId).innerHTML;
        // const printHeader = document.getElementById('print-header')?.outerHTML || '';
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // optional
    }
</script>

@endsection
@endsection