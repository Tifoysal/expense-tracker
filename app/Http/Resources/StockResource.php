<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
                'stock_id'=>$this->id,
                'product_id'=>$this->product->id,
                'product_name'=>$this->product->name,
                'product_image'=>$this->product->image,
                'total_received'=>$this->received_quantity,
                'in_stock'=>$this->available_quantity,
                'is_available'=>$this->available_quantity > 0 ? true : false,
                
        ];
    }
}
