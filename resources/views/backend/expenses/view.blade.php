@extends('backend.layouts.app')

@section('title')
    Update Expense
@endsection

@section('content'){{-- <section class="py-16 bg-gray-50 min-h-screen print-area">
    <div class="container mx-auto px-4 max-w-5xl text-[13px] leading-snug">
     <!-- Header -->
            <div class="mb-12 flex items-center justify-between">
                <div class="flex-1 text-center">
                    <h1 class="text-5xl font-black text-gray-900 mb-2 tracking-wide">UNISON ANIMAL HEALTH</h1>
                    <h2 class="text-xl font-semibold text-gray-400">
                        Expense Statement for the Month of 
                        {{ \Carbon\Carbon::parse($expense->date)->format('d M Y, h:i A') }}
                    </h2>
                </div>
                <div class="no-print flex flex-col items-end gap-2">
                    <a href="{{ route('expense.slip.pdf', [$expense->id, $expense->date]) }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 w-[160px] bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition duration-200"
                        target="_blank">
                        Download PDF
                    </a>
                  
                </div>
            </div>
    </div>
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Expense Information</h2>
                <p class="text-gray-500 mt-3 text-lg">Details for Expense: #{{ $expense->id }}</p>
            </div>

            <div class="mb-10 overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md text-gray-800 border-collapse border border-gray-300">
                    <tbody class="text-base">
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600 w-1/4">Date:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900 w-3/4">
                                {{ \Carbon\Carbon::parse($expense->date)->format('d M Y, h:i A') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Payment Method:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ ucfirst($expense->payment_method) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Account Name:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->account->name ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Amount:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ number_format($expense->amount, 2) }} BDT
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Transaction No:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->tran_no }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Category:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->expense_category->name ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Reference:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->reference ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Tax:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->tax->name ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-600">Narration:</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-900">
                                {{ $expense->narration ?? 'N/A' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if ($expense->attachment)
            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-2">Attachment:</h4>
                <a href="{{ asset('storage/'.$expense->attachment) }}" target="_blank" class="text-blue-600 hover:underline">
                    View Attachment
                </a>
            </div>
            @endif

            <!-- Signature Section -->
            <div class="mt-12 pt-8">
                <div class="grid grid-cols-3 gap-12 text-center">
                    <div>
                        <div class="border-t-2 border-gray-400 mb-1 mx-auto w-48"></div>
                        <p class="text-sm text-gray-700 font-medium -mt-1">Prepared By</p>
                    </div>
                    <div>
                        <div class="border-t-2 border-gray-400 mb-1 mx-auto w-48"></div>
                        <p class="text-sm text-gray-700 font-medium -mt-1">Checked By</p>
                    </div>
                    <div>
                        <div class="border-t-2 border-gray-400 mb-1 mx-auto w-48"></div>
                        <p class="text-sm text-gray-700 font-medium -mt-1">Approved</p>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <footer class="mt-20 text-center text-gray-600 text-sm leading-relaxed">
                <p>BIDC, Joydebpur, Gazipur-1703, Dhaka | Mobile: 01575021000, 01321232614</p>
                <p class="mt-1">Website: unison.com.bd | Email: unisonanimalhealth@gmail.com</p>
            </footer>
        </div>
    </div>
</section> --}}




<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800">UNISON ANIMAL HEALTH</h1>
            <h2 class="text-xl font-semibold text-gray-600 mt-2">Expense Statement</h2>
            <p class="text-sm text-gray-500 mt-1">
                Date: {{ \Carbon\Carbon::parse($expense->date)->format('d M Y, h:i A') }}
            </p>
        </div>
        <div class="no-print flex flex-col items-end gap-2 pb-3">
            <a href="{{ route('expense.slip.pdf', [$expense->id, $expense->date]) }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 w-[160px] bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition duration-200"
                target="_blank">
                Download PDF
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base text-gray-700">
                <div><strong>Employee Name:</strong> {{ $expense->employee->name ?? 'N/A' }}</div>
                <div><strong>Employee ID No:</strong> {{ $expense->employee->id ?? 'N/A' }}</div>
                <div><strong>Designation:</strong> {{ $expense->employee->designation->name ?? 'N/A' }}</div>
                <div><strong>Employee Type:</strong> {{ $expense->employee_type ?? 'N/A' }}</div>
                <div><strong>Employee Contact No:</strong> {{ $expense->employee->phone ?? 'N/A' }}</div>
                <div><strong>Market Location:</strong> {{ $expense->employee->address ?? 'N/A' }}</div>
                <div><strong>Name of Bill Month:</strong> {{ $expense->bill_month ?? \Carbon\Carbon::parse($expense->date)->format('F') }}</div>
                <div><strong>Bill Submission Date:</strong> {{ \Carbon\Carbon::parse($expense->date)->format('d.m.y') }}</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-8 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="border px-4 py-2">Sl. No</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Bill/Expense Purpose</th>
                        <th class="border px-4 py-2">Amount</th>
                        <th class="border px-4 py-2">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border">
                        <td class="border px-4 py-2">01</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($expense->date)->format('d.m.y') }}</td>
                        <td class="border px-4 py-2">{{ $expense->narration ?? '' }}</td>
                        <td class="border px-4 py-2">{{ number_format($expense->amount, 2) }} BDT</td>
                        <td class="border px-4 py-2">{{ $expense->reference ?? '' }}</td>
                    </tr>
                    @for ($i = 0; $i < 4; $i++)
                    <tr class="border h-12">
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                    </tr>
                    @endfor
                    <tr class="border font-semibold bg-gray-50">
                        <td class="border px-4 py-2" colspan="3" align="right">Total Amount</td>
                        <td class="border px-4 py-2">{{ number_format($expense->amount, 2) }} BDT</td>
                        <td class="border px-4 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($expense->attachment)
        <div class="mb-8">
            <h4 class="text-base font-semibold text-gray-700 mb-2">Attachment:</h4>
            <a href="{{ asset('storage/'.$expense->attachment) }}" target="_blank" class="text-blue-600 hover:underline">
                View Attachment
            </a>
        </div>
        @endif

        <div class="grid grid-cols-3 gap-4 mt-12 text-center text-sm text-gray-600">
            <div>
                <div class="border-t border-gray-400 w-32 mx-auto mb-1"></div>
                <p>Prepared By</p>
            </div>
            <div>
                <div class="border-t border-gray-400 w-32 mx-auto mb-1"></div>
                <p>Checked By</p>
            </div>
            <div>
                <div class="border-t border-gray-400 w-32 mx-auto mb-1"></div>
                <p>Approved</p>
            </div>
        </div>

        <div class="text-center text-xs text-gray-500 mt-16">
            <p>BIDC, Joydebpur, Gazipur-1703, Dhaka | Head Office: 01575021000, 01321232614</p>
            <p>Website: unison.com.bd | Email: unisonanimalhealth@gmail.com</p>
        </div>
    </div>
</section>

@endsection