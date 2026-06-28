<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiProductVariantResource extends JsonResource
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
            'product_id' => $this->product_id,
            'attribute' => $this->attribute->name,
            'variant_value' => $this->attribute_value,
            'stock' => $this->stock,
            'price' => $this->sale_price,
            'final_product_price' => $this->sale_price ,
            'formatted_final_product_price' => '৳' . $this->sale_price,
        ];
    }
}
