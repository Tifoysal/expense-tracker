<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use App\Models\BankingAccount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = BankTransfer::with(['from_account', 'to_account'])->get();
        // dd(transNumber());
        return view('backend.transfers.index')->with(compact('transfers'));
    }


    public function ajaxBankTransferList(Request $request)
    {
        // dd( $request->dateRange);
        $query = BankTransfer::with(['from_account', 'to_account'])->select('bank_transfers.*');

        // Filter by date range if provided
        if ($request->filled('dateRange')) {
            // dd($request->dateRange);
            [$start, $end] = explode(' - ', $request->dateRange);
            $start = Carbon::parse($start)->timezone(config('app.timezone'));
            $end = Carbon::parse($end)->timezone(config('app.timezone'));
            $query->whereBetween('date', [$start, $end]);
        }

        $query->orderBy('id', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->date));
            })

            ->addColumn('reference', function ($row) {
                return $row->reference ?? '';
            })

            ->addColumn('from_account_name', function ($row) {
                return $row->from_account->name ?? '';
            })

            ->addColumn('to_account_name', function ($row) {
                return $row->to_account->name ?? '';
            })

            ->addColumn('from_amount', function ($row) {
                return ($row->from_account->currency ?? '') . ' ' . number_format($row->amount, 2);
            })

            ->addColumn('to_amount', function ($row) {
                return ($row->to_account->currency ?? '') . ' ' . number_format($row->amount, 2);
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = BankingAccount::all()->where('status' , 'active');
        return view('backend.transfers.create')->with(compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [   
                    'from_account' => 'required',
                    'to_account' => 'required',
                    'date' => 'required',
                    'amount' => 'required',
                    'payment_method' => 'required',
                    'attachment' => 'file|mimes:pdf,doc,docx|max:2048',
                ]
            );
            if ($validator->fails()) {
                notify()->error('Validation Failed');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd(     $request->payment_method);
            $attachment = null;
            if($request->hasFile('attachment')){
                $attachment = date('Ymdhsis').'.'.$request->file('attachment')->getClientOriginalExtension();
                $request->file('attachment')->move(public_path('/account/transfers/attachment'), $attachment);
            }

            $fromAccount = BankingAccount::where('id', $request->from_account)->first();

            // dd($fromAccount->starting_balance, $request->amount);
            if ($request->amount >= $fromAccount->balance) {
                notify()->error('Insufficient balance in the From account.');
                return redirect()->back()->withInput();
            }

            accountDebit($request->from_account, $request->amount, $request->description, $request->reference, $request->payment_method, $attachment);

            accountCredit($request->to_account, $request->amount, $request->description, $request->reference, $request->payment_method, $attachment);


            BankTransfer::create([
                'from_account_id' => $request->from_account,
                'to_account_id' => $request->to_account,
                'date' => $request->date,
                'amount' => $request->amount,
                'description' => $request->description,
                'payment_method' => $request->payment_method,
                'reference' => $request->reference,
                'attachment' => $attachment,
            ]);
            DB::commit();
            notify()->success('Transfer Successful');
            return redirect()->route('transfer.index');
        } catch (Throwable $e) {
            DB::rollback();
            notify()->error($e->getMessage());
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
