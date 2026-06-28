<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->full_name,
            'order_id' => $this->order_id,
            'amount' => (float) $this->amount,
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'collection_date' => $this->collection_date,
            'disburse_date' => $this->disburse_date,
            'transaction_id' => $this->transaction_id,
            'receipt_file' => $this->receipt_file,
            'created_at' => $this->created_at,
        ];
    }
}
