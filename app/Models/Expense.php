<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    protected $dates = ['deleted_at']; // Specify 'deleted_at' column for soft deletes
    
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(BankingAccount::class, 'banking_account_id', 'id');
    }

    // public function category(){
    //     return $this->belongsTo(ExpenseCategory::class,'service_category_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function details()
    {
        return $this->hasMany(ExpenseDetail::class);
    }
}
