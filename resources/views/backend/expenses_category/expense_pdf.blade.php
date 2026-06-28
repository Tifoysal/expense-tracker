<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expense Slip</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5rem;
        }
        .all-td-border td, .table tr td{
            padding: 10px 12px;
            border: 1px solid #ccc;
        }
        .empty td{
            height: 2.5rem !important;
        }
        .empty-table tr td{
            text-align: center;
        }
        h1, h2 {
            margin: 0;
            padding: 0;
        }
        .text-center {
            text-align: center;
        }

        .signature div {
            width: 30%;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 40px;
            color: #555;
        }

    </style>
</head>

<body>

    <div class="text-center">
        <h1>UNISON ANIMAL HEALTH</h1>
        <h2 style="padding-top: 2rem;">Expense Statement</h2>
        <p>Date: {{ \Carbon\Carbon::parse($expense->date)->format('d M Y, h:i A') }}</p>
    </div>
        
    <table class="table">
            <tr>
                <td><strong>Employee Name:</strong>
                    {{ $expense->employee->name}}
                </td>
                <td><strong>Employee ID No:</strong> {{ $expense->employee->id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Designation:</strong> {{ $expense->employee->designation->name ?? 'N/A' }}</td>
                <td><strong>Employee Type:</strong> {{ $expense->employee_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Employee Contact No:</strong> {{ $expense->employee->phone ?? 'N/A' }}</td>
                <td><strong>Market Location:</strong> {{ $expense->employee->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Name of Bill Month:</strong> {{ $expense->bill_month ?? \Carbon\Carbon::parse($expense->date)->format('F') }}</td>
                <td><strong>Bill Submission Date:</strong> {{ \Carbon\Carbon::parse($expense->date)->format('d.m.y') }}</td>
            </tr>
        </table>


        <table class="empty-table table">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Date</th>
                    <th>Bill/Expense Purpose</th>
                    <th>Amount</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d.m.y') }}</td>
                    <td>{{ $expense->narration ?? '' }}</td>
                    {{-- <td>{{ $expense->expense_category->name ?? 'N/A' }}</td> --}}
                    <td>{{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->reference ?? '' }}</td>
                </tr>
                <tr class="empty">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="empty">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="empty">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="empty">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="empty">
                    <td></td>
                    <td></td>
                    <td style="text-align: right"><b>Total Amount</b> =</td>
                    <td>{{ number_format($expense->amount, 2) }} BDT</td>
                    <td></td>
                </tr>

            </tbody>
        </table>
        {{-- @if ($expense->attachment)
            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-2">Attachment:</h4>
                <a href="{{ asset('storage/'.$expense->attachment) }}" target="_blank" class="text-blue-600 hover:underline">
                    View Attachment
                </a>
            </div>
        @endif --}}

    <!-- Footer Section -->
    <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background: #fff;">

        <table style="width: 100%; margin-top: 40px; border-collapse: collapse;">
            <tr>
                <td style="width: 25.33%; text-align: center; vertical-align: bottom; padding-top: 10px;border-top: 1px solid #000; margin: 0 auto 3px;">
                    <p>Prepared By</p>
                </td>
                <td style="width: 10%;">
                </td>
                <td style="width: 25.33%; text-align: center; vertical-align: bottom; padding-top: 10px;border-top: 1px solid #000; margin: 0 auto 3px;">
                    <p>Checked by</p>
                </td>
                <td style="width: 10%;">
                </td>
                <td style="width: 25.33%; text-align: center; vertical-align: bottom; padding-top: 10px; border-top: 1px solid #000; margin: 0 auto 3px;">
                    <p>Approved</p>
                </td>
            </tr>
        </table>
        <p style="padding-top: 8rem;">BIDC, Joydebpur, Gazipur-1703, Dhaka | Head Office: 01575021000, 01321232614</p>
        <p>Website: unison.com.bd | Email: unisonanimalhealth@gmail.com</p>
    </div>
</body>
</html>



