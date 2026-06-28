<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
          
            'order_id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method,
            'total_amount' => (float) $this->total_amount,
            'discount_amount' => (float) $this->discount_amount,
            'payable_total' => (float) $this->payable_total,
            'commission_amount' => (float) $this->commission_amount,
            'commission_type' => $this->commission_type,
            'commission_percentage' => (float) $this->commission_percentage.'%',
            'due' => (float) $this->due,
            'paid' => (float) $this->paid,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'created_by' => $this->created_by,

            'receiver' => [
                'name' => $this->receiver_name,
                'phone' => $this->receiver_phone,
                'address' => $this->receiver_address,
            ],

            'items' => OrderDetailResource::collection($this->orderDetails),
        
        ];
    }
}
