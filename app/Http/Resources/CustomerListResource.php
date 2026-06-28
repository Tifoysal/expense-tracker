<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
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
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'business_name' => $this->business_name,
            'image' => $this->image,
            'email' => $this->email,
            'status' => $this->status,
            'phone' => $this->phone,
            'address' => $this->address,
            'employee' => optional($this->user)->name,
            'created_by' => $this->user_id,
            'commission_rate' => [
                [
                    'rate'  => 'flat',
                    'value' => (float) $this->flat_commission,
                ],
                [
                    'rate'  => 'credit',
                    'value' => (float) $this->credit_commission,
                ],
                [
                    'rate'  => 'cash',
                    'value' => (float) $this->cash_commission,
                ],
            ]

        ];
    }
}
