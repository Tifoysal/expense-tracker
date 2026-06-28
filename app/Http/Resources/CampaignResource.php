<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count=count($this->product->review);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'banner'=>$this->banner,
            'product_id'=>$this->product_id,
            'product_name'=>$this->product->name,
            'product_slug'=>$this->product->slug,
            'stock'=>$this->product->quantity,
            'rating'=>$count >0 ? round($this->product->review->sum('rating') / $count):0,
            'ratedBy'=>$count,
            'product_image'=>$this->product->image,
            'product_price'=>getPrice($this->product),
            'start_date'=>$this->start,
            'end_date'=>$this->end,
            'prize'=>(int)$this->prize,
            'total_joined'=>20,
            'target'=>$this->target,
            'description'=>$this->description,
            'is_joined'=>checkCampaignJoined($this->id,auth('api')->user()->id)
        ];
    }
}
