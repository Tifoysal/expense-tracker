<?php
namespace App\Http\Controllers;

use App\Models\BankingAccount;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'banking_account_id' => 'required|exists:banking_accounts,id',
            'amount' => 'required|numeric|min:1',
            'deposit_date' => 'required|date',
            'notes' => 'nullable|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            Deposit::create($request->all());

            // Add the dynamic capital to the respective banking ledger balance
            $account = BankingAccount::findOrFail($request->banking_account_id);
            $account->increment('balance', $request->amount);
        });

        return redirect()->route('dashboard')->with('success', 'Capital injection verified.');
    }
}