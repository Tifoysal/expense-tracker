<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTypeResource extends JsonResource
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
            'name'=>$this->name,
            'slug'=>$this->name,
            'category_id'=>$this->category_id,
            'brand_id'=>$this->brand_id,
            'image'=>asset('images/type/' . $this->image),
        ];
    }
}
