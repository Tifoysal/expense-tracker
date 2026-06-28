<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
        use HasFactory;

    protected $guarded = [];
    // {
    //     //return ServiceCategoryFactory::new();
    // }

    public function categories()
    {
        return $this->hasMany(ExpenseCategory::class,'parent_id')->with('childrenCategories');
    }

    public function parent()
     {
        return $this->belongsTo(ExpenseCategory::class,'parent_id','id');
     }

    public function childrenCategories()
    {
        return $this->hasMany(ExpenseCategory::class,'parent_id')->with('categories');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_category_id');
    }


    // public function expenses()
    // {
    //     return $this->hasMany(Expense::class,'expense_category_id');
    // }
}
