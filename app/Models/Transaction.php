<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const CREDIT = 'credit';
    public const DEBIT = 'debit';

    public function service()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(BankingAccount::class, 'account_id', 'id');
    }
}
