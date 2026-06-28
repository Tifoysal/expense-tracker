<?php

namespace App\Http\Controllers;

use App\Models\BankingAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BankingAccountController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = BankingAccount::latest()->paginate(15);
        return view('backend.banking_account.index', compact('accounts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banking_account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'type' => 'required',
                    'name' => 'required|max:255',
                    'starting_balance' => 'required',
                    // 'bank_phone' => 'required_unless:type,cash|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
                    'bank_phone' => 'exclude_if:type,cash|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',

                    // 'bank_phone' => 'min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
                ]
            );

            if ($validator->fails()) {
                notify()->error('Validation Failed');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // default account
            if ($request->default_account == 1) {
                BankingAccount::query()->update([
                    'default_account' => 0,
                ]);
            }

            BankingAccount::create([
                'type' => $request->type,
                'name' => $request->name,
                'account_no' => $request->account_no,
                'currency' => $request->currency,
                'starting_balance' => $request->starting_balance,
                'balance' => $request->starting_balance,
                'default_account' => $request->default_account,
                'bank_name' => $request->bank_name,
                'bank_phone' => $request->bank_phone,
                'bank_address' => $request->bank_address,
                'created_by'  => Auth::user()->id,
            ]);

            DB::commit();
            notify()->success('Account Created Successfully!');
            return redirect()->route('banking.account.index');
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
        // dd($id);
        $account = BankingAccount::find($id);
        return view('backend.banking_account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $account = BankingAccount::find($id);
        return view('backend.banking_account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $account = BankingAccount::find($id);
            if ($account) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'type' => 'required',
                        'name' => 'required|max:255',
                        'starting_balance' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    notify()->error('Validation Failed');
                    return redirect()->back()->withErrors($validator)->withInput();
                }


                if ($request->default_account == 1) {
                    BankingAccount::query()->update([
                        'default_account' => 0,
                    ]);
                }

                $account->update([
                    'type' => $request->type,
                    'name' => $request->name,
                    'account_no' => $request->account_no,
                    'currency' => $request->currency,
                    'starting_balance' => $request->starting_balance,
                    'balance' => $request->starting_balance,
                    'default_account' => $request->default_account,
                    'bank_name' => $request->bank_name,
                    'bank_phone' => $request->bank_phone,
                    'bank_address' => $request->bank_address,
                ]);

                DB::commit();
                notify()->success('Account Updated Successfully!');
                return redirect()->route('banking.account.index');
            }
            notify()->error('Account not found');
            return redirect()->route('banking.account.index');
        } catch (Throwable $e) {
            DB::rollback();
            notify()->error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $account = BankingAccount::find($id);
        if ($account) {
            $account->delete();

            notify()->success("Account deleted successfully!");
            return redirect()->back();
        }
        notify()->error("Account not found!");
        return redirect()->back();
    }

    public function toggleStatus(BankingAccount $account)
    {
        $account->status = $account->status === 'active' ? 'frozen' : 'active';
        $account->save();

        return response()->json([
            'success' => true,
            'status' => $account->status
        ]);
    }
}
