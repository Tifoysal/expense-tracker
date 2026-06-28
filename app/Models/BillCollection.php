<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillCollection extends Model
{
    use HasFactory;
    protected $guarded=[];

    const APPROVED = "approved";
    const PENDING = "pending";
    const CANCELLED = "cancelled";
    const DISBURSED = "disbursed";
    const RECEIVED = "received";

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id');
    }
}

