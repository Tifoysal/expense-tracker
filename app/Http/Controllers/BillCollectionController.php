<?php

namespace App\Http\Controllers;

use App\Exports\ExportBillCollection;
use App\Models\BankingAccount;
use App\Models\BillCollection;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillCollectionController extends Controller
{
    public function list()
{
    // Initialize defaults as collections/zeros
    $bills          = collect(); 
    $totalPaid      = 0;
    $totalPurchase  = 0;
    $totalDue       = 0;

    $month    = request('month', now()->month);
    $year     = request('year', now()->year);
    $status   = request('status'); // Get status from request
    $employeeId = request('id');

    if ($employeeId) {
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate   = Carbon::create($year, $month, 1)->endOfMonth();

        $bills = BillCollection::where('employee_id', $employeeId)
            ->whereBetween('collection_date', [$startDate, $endDate])
            // Dynamic Status Filter
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->get();

        // Calculate Paid based on the filtered bills
        $totalPaid = $bills->sum('amount');

        // Total Due usually reflects the whole month's orders regardless of bill status
        $totalDue = Order::where('created_by', $employeeId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('due');

        $totalPurchase = $totalPaid + $totalDue;
    }

    $employees = User::whereHas('role', function ($query) {
        $query->where('slug', 'employee');
    })->orderBy('id', 'DESC')->get();

    return view('backend.bills.list', compact('employees', 'bills', 'totalDue', 'totalPaid', 'totalPurchase'));
}

    public function view($bill_id)
    {
        $bill = BillCollection::find($bill_id);
        $accountHeads = BankingAccount::all()->where('status', 'active');

        return view('backend.bills.view', compact('bill', 'accountHeads'));
    }

    public function edit($bill_id)
    {
        $bill = BillCollection::find($bill_id);

        return view('backend.bills.edit', compact('bill'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'collection_date' => 'required|date'
        ]);

        $bill = BillCollection::findOrFail($id);
        $bill->collection_date = $request->collection_date;
        $bill->save();

        notify()->success('Bill date updated successfully.');
        return redirect()->back();
    }

    public function creditBill(Request $request, $id)
    {
        $request->validate([
            'account_head_id' => 'required|exists:banking_accounts,id',
        ]);

        $bill = BillCollection::findOrFail($id);

        if ($bill->status === 'disbursed') {
            DB::transaction(function () use ($bill, $request) {
                // Example: Create a transaction record or ledger entry
                $bill->banking_account_id = $request->account_head_id;
                $bill->status = 'received';
                $bill->updated_at = now(); // optional timestamp
                $bill->updated_by = auth()->user()->id; // optional timestamp
                $bill->save();

                // If you use a Ledger/Transaction model:
                accountCredit(
                    $request->account_head_id,        // to_account
                    $bill->amount,                    // amount
                    $bill->narration ?? 'Bill credit', // description
                    $bill->id,              // reference
                    $bill->payment_type,             // payment method
                    null                              // attachment, if any
                );
            });

            return redirect()->route('bill.view', $bill->id)->with('success', 'Bill successfully credited to selected account head.');
        } elseif ($bill->status === 'received') {
            notify()->error('This bill has already been credited.');
            return redirect()->back();
        } else {
            notify()->error('This bill not yet disbursed.');
            return redirect()->back();
        }
    }



    public function export(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $fileName = 'statement-E' . $employeeId . '-' . $month . '-' . $year . '.xlsx';

        return Excel::download(new ExportBillCollection($employeeId, $month, $year), $fileName);
    }
}
