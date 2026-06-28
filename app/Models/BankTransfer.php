<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    use HasFactory;

        protected $guarded = [];

    public function getAttachmentAttribute($value)
    {
        if($value){

            return asset('account/transfers/attachment/' . $value);

        }else{

            return null;

        }
    }

    public function from_account()
    {
        return $this->belongsTo(BankingAccount::class, 'from_account_id');
    }

    public function to_account()
    {
        return $this->belongsTo(BankingAccount::class, 'to_account_id');
    }
}
