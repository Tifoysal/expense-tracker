<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['banking_account_id', 'amount', 'deposit_date', 'notes'];

    public function bankingAccount() {
        return $this->belongsTo(BankingAccount::class);
    }
}
