<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(auth('api')->check() && in_array(auth('api')->user()->type,['dealer','corporate']))
        {
            $discount['amount']=0;
            $discount['percentage']=0;
           
        }else{
            $discount=getDiscountedPriceFromRule( $this['product']->discount_type,getPrice($this['product']),$this['product']->discount,1);
        }
        

        return [
            'id' => $this['product']->id,
            'slug' => $this['product']->slug,
            'name' => $this['product']->name,
            'stock' => $this['product']->stock->available_quantity ?? 0,
            'brand_id' => $this['product']->brand_id,
            'brand_name' => optional($this['product']->brand)->name,
            'type_id' => $this['product']->type_id,
            'category_id' => $this['product']->category_id,
            'category_name' => $this['product']->category->name,
            'short_description' => $this['product']->short_description,
            'long_description' => $this['product']->long_description,
            'price' => getPrice($this['product']),
            'discount_percentage' => $discount['percentage'],
            'discount_amount' => $discount['amount'],
            'final_product_price' => round((getPrice($this['product']) - $discount['amount']), 2),
            'formatted_final_product_price' => '৳' . round((getPrice($this['product']) - $discount['amount']), 2),
            'quantity' => $this['product']->quantity,
            'primary_image' => $this['product']->image,
            'image' => $this['product']->productImages,
            'review' => ReviewResource::collection($this['product']->review),
            'related_product' => ParentProductResource::collection($this['related_products']),

        ];
    }
}
