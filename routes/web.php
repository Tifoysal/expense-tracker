<?php

use App\Models\DealerStock;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Backend\ChangePassword;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\BankingAccountController;
use App\Http\Controllers\BillCollectionController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ForgetPasswordController;
use App\Http\Controllers\Backend\ReportsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/post', [LoginController::class, 'loginPost'])->name('login.post');

// Forget pass
Route::get('/forget/password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('/forget/password/post', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('admin.forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('/reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordPost'])->name('admin.reset.password.post');

Route::group(['middleware' => ['auth:web,customers']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'users', 'module' => 'Users'], function () {
        Route::get('/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('user.profile');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/block/{id}', [UserController::class, 'block'])->name('user.block');
        Route::get('/unblock/{id}', [UserController::class, 'unblock'])->name('user.unblock');
        Route::get('/change-password', [ChangePassword::class, 'changePassword'])->name('changePassword');
        Route::post('/change-password', [ChangePassword::class, 'changePasswordProcess'])->name('change.password.process');
    });

    // Bill
    Route::group(['prefix' => 'bill', 'module' => 'Bill'], function () {
        Route::get('/list', [BillCollectionController::class, 'list'])->name('bill.list');
        Route::get('/view/{bill_id}', [BillCollectionController::class, 'view'])->name('bill.view');
        Route::get('/edit/{bill_id}', [BillCollectionController::class, 'edit'])->name('bill.edit');
        Route::put('/update/{bill_id}', [BillCollectionController::class, 'update'])->name('bill.update');
        Route::post('/credit/{bill_id}', [BillCollectionController::class, 'creditBill'])->name('bill.credit');
        Route::get('/export', [BillCollectionController::class, 'export'])->name('bill.export');
    });

    Route::group(['prefix' => 'transaction', 'module' => 'Transaction'], function () {
        Route::get('transaction/index', [TransactionController::class, 'index'])->name('transaction.index');

        Route::get('transaction-list-ajax', [TransactionController::class, 'ajaxTransactionList'])->name('transaction.ajaxTransactionList');


        Route::get('transaction/show/{id}', [TransactionController::class, 'show'])->name('transaction.show');

        Route::get('transaction/statement', [TransactionController::class, 'transactionStatement'])->name('transaction.statement');
    });

    Route::group(['prefix' => 'expenses', 'module' => 'Expense'], function () {
        Route::get('category/create', [ExpenseController::class, 'expenseCategoryCreate'])->name('expenses.category.create');
        Route::post('category/store', [ExpenseController::class, 'expenseCategoryStore'])->name('expenses.category.store');
        Route::get('category/list', [ExpenseController::class, 'expenseCategoryList'])->name('expenses.category.list');
        Route::get('category/edit/{id}', [ExpenseController::class, 'expenseCategoryEdit'])->name('expenses.category.edit');
        Route::put('category/update/{id}', [ExpenseController::class, 'expenseCategoryUpdate'])->name('expenses.category.update');
        Route::get('category/delete/{id}', [ExpenseController::class, 'expenseCategoryDelete'])->name('expenses.category.delete');

        Route::get('index', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('expense-list-ajax', [ExpenseController::class, 'ajaxExpenseList'])->name('expenses.ajaxExpenseList');
        Route::get('create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('store', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('show/{id}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::get('view/{id}', [ExpenseController::class, 'view'])->name('expenses.view');
        Route::get('/expense/slip/pdf/{expense}/{date}', [ExpenseController::class, 'downloadPdf'])->name('expenses.slip.pdf');
        Route::post('update/{id}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::get('destroy/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
        Route::post('/expenses/{id}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
        Route::post('/expenses/{id}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');
    });

    Route::group(['prefix' => 'transfer', 'module' => 'Transfer'], function () {
        Route::get('index', [TransferController::class, 'index'])->name('transfer.index');


        Route::get('transfer-list-ajax', [TransferController::class, 'ajaxBankTransferList'])->name('transfer.ajaxBankTransferList');


        Route::get('create', [TransferController::class, 'create'])->name('transfer.create');
        Route::post('store', [TransferController::class, 'store'])->name('transfer.store');
        // Route::get('/', 'index')->name('banking.transfer.index');
        // Route::get('/create', 'create')->name('banking.transfer.create');
        // Route::post('/store', 'store')->name('banking.transfer.store');
    });

    Route::group(['prefix' => 'banking-account', 'module' => 'Banking Account'], function () {
        Route::get('index', [BankingAccountController::class, 'index'])->name('banking.account.index');
        Route::get('edit/{id}', [BankingAccountController::class, 'edit'])->name('banking.account.edit');
        Route::get('banking-account-list-ajax', [BankingAccountController::class, 'ajaxBankingAccountList'])->name('bankingAccount.ajaxBankingAccountList');
        Route::get('create', [BankingAccountController::class, 'create'])->name('banking.account.create');
        Route::post('store', [BankingAccountController::class, 'store'])->name('banking.account.store');
        Route::get('show/{id}', [BankingAccountController::class, 'show'])->name('banking.account.show');
        Route::post('update/{id}', [BankingAccountController::class, 'update'])->name('banking.account.update');
        Route::delete('destroy/{id}', [BankingAccountController::class, 'destroy'])->name('banking.account.destroy');
        Route::post('/status-switch/{account}', [BankingAccountController::class, 'toggleStatus']);

        // Route::resource('/leaves', LeaveController::class);
    });

    Route::group(['prefix' => 'reports', 'module' => 'Reports', 'as' => 'reports.'], function () {
        Route::get('/profit-loss-report', [ReportsController::class, 'profitLossReport'])->name('sale.profit-loss');
        Route::get('/yearly-summary-index', [ReportsController::class, 'yearlySummaryIndex'])->name('yearly.summary.index');
        Route::get('/yearly-summary', [ReportsController::class, 'yearlySummary'])->name('yearly.summary');
        Route::get('/summary-customers-invoices', [ReportsController::class, 'customerInvoices'])->name('customer.invoices');
    });

    Route::group(['prefix' => 'settings', 'module' => 'Settings'], function () {
        Route::get('/', [SettingController::class, 'show'])->name('settings');
        Route::put('/update', [SettingController::class, 'settings'])->name('settings.update');
    });

    Route::group(['prefix' => 'roles', 'module' => 'Roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.list');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });

});
   
