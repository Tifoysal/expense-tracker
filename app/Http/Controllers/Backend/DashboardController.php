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
use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Test;
use App\Models\Training;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // 1. Capital Balances
        $accounts = BankingAccount::all();
        $totalPoolBalance = $accounts->sum('balance');

        // 2. Aggregate Metrics (historical - all time)
        $historicalTotalExpense = ExpenseDetail::sum('amount');

        // 3. Month / Year filter (default = current month)
        $now         = Carbon::now();
        $filterYear  = $request->filled('year')  ? (int) $request->year  : $now->year;
        $filterMonth = $request->filled('month') ? (int) $request->month : $now->month;

        // Clamp values to valid ranges
        if ($filterMonth < 1 || $filterMonth > 12) {
            $filterMonth = $now->month;
        }

        $filterDate   = Carbon::createFromDate($filterYear, $filterMonth, 1);
        $startOfMonth = $filterDate->copy()->startOfMonth();
        $endOfMonth   = $filterDate->copy()->endOfMonth();

        // Expenses for the selected month (filtering by the master mamla_date)
        $thisMonthTotalExpense = ExpenseDetail::whereHas('expense', function ($q) use ($startOfMonth, $endOfMonth) {
            $q->whereBetween('mamla_date', [$startOfMonth, $endOfMonth]);
        })->sum('amount');

        // Expense history for the selected month, newest first
        $expenseHistory = ExpenseDetail::with(['expense', 'expenseCategory'])
            ->whereHas('expense', function ($q) use ($startOfMonth, $endOfMonth) {
                $q->whereBetween('mamla_date', [$startOfMonth, $endOfMonth]);
            })
            ->orderByDesc('id')
            ->get();

        // Distinct years that have expenses (for the year dropdown)
        $availableYears = Expense::selectRaw('DISTINCT YEAR(mamla_date) as y')
            ->whereNotNull('mamla_date')
            ->orderByDesc('y')
            ->pluck('y')
            ->toArray();

        // Make sure the current year is present in the dropdown
        if (!in_array((int) $now->year, $availableYears, true)) {
            $availableYears[] = (int) $now->year;
            rsort($availableYears);
        }

        $months = [
            1  => 'January',
            2  => 'February',
            3  => 'March',
            4  => 'April',
            5  => 'May',
            6  => 'June',
            7  => 'July',
            8  => 'August',
            9  => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        return view('backend.dashboard.index', compact(
            'accounts',
            'totalPoolBalance',
            'historicalTotalExpense',
            'thisMonthTotalExpense',
            'expenseHistory',
            'filterMonth',
            'filterYear',
            'months',
            'availableYears'
        ));
    }
}