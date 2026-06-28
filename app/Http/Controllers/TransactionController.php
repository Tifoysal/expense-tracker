<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\BankingAccount;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function transactionStatement(Request $request)
    {

        $bankingAccounts = BankingAccount::all();

        // Retrieve form input
        $bankingAccountName = $request->input('bankingAccountName');
        $month = $request->input('month');
        $year = $request->input('year');
        // Query transactions based on form input
        $query = Transaction::query();

        if ($bankingAccountName) {
            $query->whereHas('account', function ($query) use ($bankingAccountName) {
                $query->where('name', $bankingAccountName);
            });
        }
        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('backend.transaction.statement', compact('transactions', 'bankingAccounts','month','year'));
    }

    public function index(Request $request)
    {
        // $filter = [];
        if ($request->type) {
            if ($request->type == "credit") {
                $tran = Transaction::where('type', $request->type)->latest()->paginate(10);
            } elseif ($request->type == "debit") {
                $tran = Transaction::where('type', $request->type)->latest()->paginate(10);
            } elseif ($request->type == "all") {
                $tran = Transaction::latest()->paginate(10);
            }
        } else {
            $tran = Transaction::latest()->paginate(10);
        }
        return view('backend.transaction.index', compact('tran'));
    }


    public function ajaxTransactionList(Request $request)
    {
        $query = Transaction::with('account')->select('transactions.*');
        // Filter by date range if provided
        if ($request->filled('dateRange')) {
            [$start, $end] = explode(' - ', $request->dateRange);
            $start = Carbon::parse($start)->timezone(config('app.timezone'));
            $end = Carbon::parse($end)->timezone(config('app.timezone'));
            $query->whereBetween('created_at', [$start, $end]);
        }
        if ($request->filled('type') && in_array($request->type, ['credit', 'debit'])) {
            $query->where('type', $request->type);
        }
        $query->orderBy('id', 'desc');
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('account_name', function ($row) {
                return $row->account->name ?? '';
            })

            ->addColumn('created_at', function ($row) {
                return date('d-M-Y H:i:s', strtotime($row->created_at));
            })

            ->addColumn('number', function ($row) {
                return $row->number;
            })

            ->addColumn('description', function ($row) {
                return $row->description;
            })

            ->addColumn('credit', function ($row) {
                return $row->type === 'credit' ? $row->amount . ' BDT' : 'N/A';
            })

            ->addColumn('debit', function ($row) {
                return $row->type === 'debit' ? $row->amount . ' BDT' : 'N/A';
            })

            ->addColumn('after_balance', function ($row) {
                return $row->after_balance;
            })

            ->make(true);
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $account = BankingAccount::all();
        // $vendor = Vendor::all();
        $customer = Customer::all();
        $tax = Tax::all();
        $tran = Transaction::find($id);
        return view('account::transaction.show', compact('tran', 'account', 'cat_service', 'customer',  'tax'));
    }

    public function edit($id)
    {
        return view('edit');
    }
}
