<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Throwable;
use App\Models\Tax;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\BankingAccount;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Models\ExpenseCategory;
use App\Models\ExpenseDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function expenseCategoryList()
    {
        $categories = ExpenseCategory::orderBy('id', 'DESC')->get();
        return view('backend.expenses_category.list', compact('categories'));
    }

    public function expenseCategoryCreate()
    {
        $categories = ExpenseCategory::where('parent_id', 0)->with('childrenCategories')->get();
        $hi_pen = '';
        return view('backend.expenses_category.create', compact('categories', 'hi_pen'));
    }

    public function expenseCategoryStore(Request $request)
    {

        ExpenseCategory::create([
            'parent_id' => $request->parent_id,
            'name' => $request->category_name,
            'status' => $request->status,
        ]);
        notify()->success('Expense Category created successfully.');
        return redirect()->route('expenses.category.list');
    }

    public function expenseCategoryEdit($id)
    {
        $category = ExpenseCategory::find($id);
        $categories = ExpenseCategory::where('parent_id', 0)->orderBy('id', 'DESC')->get();
        $hi_pen = '';
        return view('backend.expenses_category.edit', compact('categories', 'category', 'hi_pen'));
    }

    public function expenseCategoryUpdate(Request $request, $id)
    {

        $category = ExpenseCategory::find($id);

        $category->update([
            'parent_id' => $request->parent_id,
            'name' => $request->category_name,
            'status' => $request->status,
        ]);
        notify()->success('Expense Category updated successfully.');
        return redirect()->route('expenses.category.list');
    }

    public function expenseCategoryDelete($id)
    {
        ExpenseCategory::find($id)->delete();
        notify()->success('Expense Category deleted successfully.');
        return redirect()->route('expenses.category.list');
    }

    // public function index()
    // {
    //     $user = auth()->user();

    //     $hasNonPending = Expense::where('status', '!=', 'pending')->exists();

    //     $expense = Expense::latest()->paginate(10);
    //     $categories = ExpenseCategory::all();

    //     $employees = User::whereHas('role', function ($query) {
    //         $query->where('slug', 'employee');
    //     })->orderBy('id', 'DESC')->get();

    //     return view('backend.expense.index', compact('expense', 'user', 'hasNonPending','categories','employees'));
    // }


    // public function ajaxExpenseList(Request $request)
    // {
    //     $user = auth()->user();
    //     $role = $user->role->slug ?? null;

    //     $query = Expense::with(['account', 'expense_category', 'user', 'employee'])
    //         ->select('expenses.*');

    //     // Role filter
    //     if ($role === 'employee') {
    //         $query->where('user_id', $user->id);
    //     }

    //     // Date filter
    //     if ($request->filled('dateRange')) {
    //         [$start, $end] = explode(' - ', $request->dateRange);

    //         $query->whereBetween('date', [
    //             Carbon::parse($start)->startOfDay(),
    //             Carbon::parse($end)->endOfDay()
    //         ]);
    //     }

    //     // Category filter
    //     if ($request->filled('category')) {
    //         $query->whereHas('expense_category', function ($q) use ($request) {
    //             $q->where('name', $request->category);
    //         });
    //     }

    //     // Payment filter
    //     if ($request->filled('payment_method')) {
    //         $query->where('payment_method', $request->payment_method);
    //     }

    //     // Employee filter
    //     if ($request->filled('employee_id')) {
    //         $query->where('employee_id', $request->employee_id);
    //     }

    //     // TOTAL
    //     $total = (clone $query)->sum('amount');

    //     return DataTables::of($query)

    //         ->filter(function ($query) use ($request) {

    //             if ($search = $request->input('search.value')) {

    //                 $query->where(function ($q) use ($search) {

    //                     $clean = str_replace(',', '', $search);

    //                     $q->where('expenses.id', 'like', "%{$search}%")
    //                       ->orWhere('expenses.payment_method', 'like', "%{$search}%")
    //                       ->orWhere('expenses.tran_no', 'like', "%{$search}%")
    //                       ->orWhere('expenses.status', 'like', "%{$search}%")

    //                       // ✅ FIXED amount search
    //                       ->orWhereRaw("expenses.amount LIKE ?", ["%{$clean}%"])

    //                       ->orWhereHas('employee', fn($q2) =>
    //                           $q2->where('name', 'like', "%{$search}%")
    //                       )
    //                       ->orWhereHas('user', fn($q2) =>
    //                           $q2->where('name', 'like', "%{$search}%")
    //                       )
    //                       ->orWhereHas('expense_category', fn($q2) =>
    //                           $q2->where('name', 'like', "%{$search}%")
    //                       );
    //                 });
    //             }

    //         })

    //         ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->date)))
    //         ->addColumn('created_by', fn($row) => $row->user->name ?? '')
    //         ->addColumn('employee_id', fn($row) => $row->employee->name ?? '')
    //         ->addColumn('payment_method', fn($row) => $row->payment_method)
    //         ->addColumn('amount', fn($row) => number_format($row->amount, 2))
    //         ->addColumn('category_name', fn($row) => $row->expense_category->name ?? '')
    //         ->addColumn('tran_no', fn($row) => $row->tran_no ?? '')
    //         ->addColumn('status', fn($row) => ucfirst($row->status ?? ''))

    //         ->addColumn('action', function ($row) use ($role) {

    //             if ($role !== 'super-admin' &&
    //                 in_array(strtolower($row->status), ['approved', 'rejected'])) {
    //                 return '';
    //             }

    //             return '<a href="'.route('expense.view',$row->id).'" class="text-blue-500">View</a>';
    //         })

    //         ->with(['total' => $total])

    //         ->rawColumns(['action'])
    //         ->make(true);
    // }


    // public function create()
    // {
    //     $account = BankingAccount::all()->where('status' , 'active');
    //     $employees = User::whereHas('role', function ($query) {
    //         $query->where('slug', 'employee');
    //     })->orderBy('id', 'DESC')->get();
    //     // $vendor = Vendor::all();
    //     $tax = Tax::all();
    //     $categories = ExpenseCategory::where('parent_id', 0)->with('childrenCategories')->get();
    //     $hi_pen = '';
    //     return view('backend.expenses.create', compact('account', 'tax', 'categories', 'hi_pen','employees'));
    // }

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $validator = Validator::make(
    //             $request->all(),
    //             [
    //                 'date' => 'required',
    //                 'payment_method' => 'required',
    //                 'account_no' => 'required',
    //                 'amount' => 'required',
    //                 'tran_no' => 'required',
    //                 'category_id' => 'required',
    //             ]
    //         );

    //         if ($validator->fails()) {
    //             notify()->error('Validation Failed');
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $attachment = null;
    //         if ($request->hasFile('attachment')) {
    //             $file = $request->file('attachment');
    //             $attachment = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
    //             $file->move(public_path('/expense'), $attachment);
    //         }
    //         // dd($request->account_no);
    //         $bankAccount = BankingAccount::find($request->account_no);

    //         // dd($bankAccount->balance);

    //         // dd($request->amount, $bankAccount->balance);

    //         if ($request->amount > $bankAccount->balance) {
    //             notify()->error('Expense amount exceeds bank account balance.');
    //             return redirect()->back()->withInput();
    //         }
    //         Expense::create([
    //             'date' => $request->date,
    //             'payment_method' => $request->payment_method,
    //             'banking_account_id' => $request->account_no,
    //             'amount' => $request->amount,
    //             'narration' => $request->narration,
    //             'expense_category_id' => $request->category_id,
    //             'tax_id' => $request->tax,
    //             'tran_no' => $request->tran_no,
    //             'reference' => $request->reference,
    //             'attachment' => $attachment,
    //             'status' => 'pending',
    //             'user_id' => auth()->id(),
    //             'employee_id' => $request->emp_id ??  auth()->id(),
    //         ]);

    //         DB::commit();
    //         notify()->success('Expense Created Successfully!');
    //         return redirect()->route('expense.index');
    //     } catch (Throwable $e) {
    //         DB::rollback();
    //         notify()->error($e->getMessage());
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    // }

    // public function approve($id)
    // {
    //     $expense = Expense::findOrFail($id);
    //     $bankAccount = BankingAccount::find($expense->banking_account_id);
    //     if ($bankAccount && $expense->amount > $bankAccount->balance) {
    //         notify()->error('Expense amount exceeds bank account balance.');
    //         return redirect()->back();
    //     }
    //     $expense->update(['status' => 'approved']);
    //     accountDebit($expense->banking_account_id, $expense->amount, $expense->narration, $expense->reference, $expense->payment_method, $expense->attachment);
    //     notify()->success('Expense Approved');
    //     return redirect()->back();
    // }

    // public function reject($id)
    // {
    //     $expense = Expense::findOrFail($id);
    //     $expense->update(['status' => 'rejected']);
    //     notify()->success('Expense Rejected');
    //     return redirect()->back();
    // }

    // public function show($id)
    // {
    //     $account = BankingAccount::all();
    //     // $employee = User::find
    //     // $vendor = Vendor::all();
    //     $tax = Tax::all();
    //     $expense = Expense::with('employee')->find($id);
    //     $categories = ExpenseCategory::where('parent_id', 0)->orderBy('id', 'DESC')->get();
    //     $hi_pen = '';
    //     return view('backend.expense.show', compact('expense', 'account', 'tax', 'categories', 'hi_pen'));
    // }

    // public function edit($id)
    // {
    //     return view('backend.expense.edit');
    // }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $expense = Expense::find($id);
    //         if ($expense) {
    //             $validator = Validator::make(
    //                 $request->all(),
    //                 [
    //                     'date' => 'required',
    //                     'payment_method' => 'required',
    //                     'account_no' => 'required',
    //                     'tran_no' => 'required',
    //                     'category_id' => 'required',
    //                     'amount' => 'required',
    //                 ]
    //             );
    //             if ($validator->fails()) {
    //                 notify()->error('Validation Failed');
    //                 return redirect()->back()->withErrors($validator)->withInput();
    //             }

    //             $attachment = $expense->getRawOriginal('attachment');
    //             if ($request->hasFile('attachment')) {
    //                 $remove = public_path() . '/transaction/expense/' . $attachment;
    //                 File::delete($remove);
    //                 $attachment = date('Ymdhsis') . '.' . $request->file('attachment')->getClientOriginalExtension();
    //                 $request->file('attachment')->move(public_path('/transaction/expense'), $attachment);
    //             }

    //             $bankAccount = BankingAccount::find($request->account_no);
    //             if ($bankAccount && $request->amount > $bankAccount->balance) {
    //                 notify()->error('Expense amount exceeds bank account balance.');
    //                 return redirect()->back()->withInput();
    //             }
    //             $expense->update([
    //                 'date' => $request->date,
    //                 'payment_method' => $request->payment_method,
    //                 'banking_account_id' => $request->account_no,
    //                 'narration' => $request->narration,
    //                 'expense_category_id' => $request->category_id,
    //                 // 'vendor_id' => $request->vendor,
    //                 'tax_id' => $request->tax,
    //                 'tran_no' => $request->tran_no,
    //                 'reference' => $request->reference,
    //                 'attachment' => $attachment,
    //                 'employee_id' => $request->employee_id,
    //             ]);
    //             notify()->success('Data Updated Successfully!');
    //             return redirect()->route('expense.index');
    //         }
    //         notify()->error('Data not found');
    //         return redirect()->route('expense.index');
    //     } catch (Throwable $e) {
    //         notify()->error($e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    // public function destroy($id)
    // {
    //     $expense = Expense::find($id);
    //     if ($expense) {
    //         //transaction 
    //         accountCredit($expense->banking_account_id, $expense->amount, $expense->narration, $expense->reference, $expense->payment_method, $expense->attachment);
    //         $expense->delete();

    //         notify()->success("Data deleted successfully!");
    //         return redirect()->back();
    //     }
    //     notify()->error("Data not found!");
    //     return redirect()->back();
    // }

    // public function view($id)
    // {
    //     $expense = Expense::with(['user.designation', 'expense_category', 'tax', 'employee'])->findOrFail($id);

    //     return view('backend.expense.view', compact('expense'));
    // }

    // public function downloadPdf(Expense $expense, $date)
    // {
    //     // Load relations
    //     $expense->load(['account', 'expense_category', 'tax', 'employee']);

    //     // Generate the view HTML
    //     $html = view('backend.expense.expense_pdf', compact('expense'))->render();

    //     // Create PDF using Mpdf
    //     $mpdf = new Mpdf([
    //         'default_font_size' => 12,
    //         'default_font' => 'sans-serif',
    //         'mode' => 'utf-8',
    //         'format' => 'A4',
    //     ]);

    //     // Write the HTML content to the PDF
    //     $mpdf->WriteHTML($html);

    //     // Return the PDF inline
    //     return $mpdf->Output("expense-slip-{$expense->id}.pdf", 'I');
    // }

    public function index(Request $request)
    {
        $accounts = BankingAccount::all();

        // Distinct types for filter dropdown
        $types = ExpenseCategory::all();

        // Query detailed list with filters applied
        $query = ExpenseDetail::with('expense');

        if ($request->filled('mamla_date')) {
            $query->whereHas('expense', function ($q) use ($request) {
                $q->where('mamla_date', $request->mamla_date);
            });
        }

        if ($request->filled('type')) {
            $query->where('expense_category_id', $request->type);
        }

        $expenses = $query->orderBy('id', 'desc')->get();

        return view('backend.expenses.index', compact('expenses', 'accounts', 'types'));
    }

    public function create()
    {
        $types = ExpenseCategory::all();

        return view('backend.expenses.create', compact('types'));
    }

    public function store(Request $request)
    {

        try {



            // 1. Validate the parent date and the nested line items array
            $validate = Validator::make($request->all(), [
                'mamla_date'                  => 'required|date',
                'expenses'                    => 'required|array|min:1',
                'expenses_remarks'            => 'required|string|min:5',
                'expenses.*.title'            => 'required|string|max:255',
                'expenses.*.type'             => 'required|string|max:255',
                'expenses.*.total_amount'     => 'required|numeric|min:0.01',
            ]);

            if ($validate->fails()) {
                notify()->error($validate->getMessageBag());
                return redirect()->back();
            }

            // 2. Execute within a safe database transaction block
            DB::transaction(function () use ($request) {

                // Find an existing master date record or create a new one
                $expense = Expense::firstOrCreate([
                    'mamla_date' => $request->mamla_date,
                    'representative' => $request->representative,
                    'remarks' => $request->remarks,
                    'user_id' =>auth()->user()->id,
                    'payment_method' =>'cash',
                ]);

                
                $totalAmount = 0;
                // 3. Loop through each submitted individual expense item
                foreach ($request->expenses as $item) {
                    $totalAmount = $totalAmount + $item['total_amount'];

                    // Save the audit ledger entry for the specific row
                    ExpenseDetail::create([
                        'expense_id'     => $expense->id,
                        'title'          => $item['title'],
                        'expense_category_id'           => $item['type'],
                        'amount'         => $item['total_amount'],
                    ]);
                }
                $splitAmount = $totalAmount / 3; // Evenly split across the 3 accounts
                // 4. Instantly decrement the calculated split amount from all 3 accounts
                BankingAccount::query()->decrement('balance', $splitAmount);
            });

            notify()->success('Expense split processed successfully across accounts.');

            return redirect()->back();
        } catch (Throwable $ex) {
            notify()->error($ex->getMessage());
            return redirect()->back();
        }
    }
}
