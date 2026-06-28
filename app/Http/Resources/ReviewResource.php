<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'rating'=>$this->rating,
            'customer_name'=>optional($this->customer)->first_name.' '.optional($this->customer)->last_name,
            'customer_image'=>optional($this->customer)->image,
            'comments'=>$this->comment
        ];
    }
}
