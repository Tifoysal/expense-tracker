<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\BankingAccount;
use App\Models\BillCollection;
use App\Models\Customer;
use App\Models\ExpenseDetail;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Test;
use App\Models\Training;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  
    public function index()
    {
        // 1. Capital Balances
        $accounts = BankingAccount::all();
        $totalPoolBalance = $accounts->sum('balance');

        // 2. Aggregate Metrics
        $historicalTotalExpense = ExpenseDetail::sum('amount');
    
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();
        
        $thisMonthTotalExpense = ExpenseDetail::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

       

        return view('backend.dashboard.index', compact(
            'accounts', 
            'totalPoolBalance', 
            'historicalTotalExpense', 
            'thisMonthTotalExpense'
        ));
    }


}
