<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCheckingResource extends JsonResource
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
            'customer_name' => $this->customer->full_name ?? 'Unknown',
            'customer_mobile' => $this->customer->phone,
            'customer_address' => $this->customer->address,
            'image' => $this->customer->image,
            'checking_time' => $this->created_at->format('h:i A'),
        ];
    }
}
