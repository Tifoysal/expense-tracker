<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;

class WishlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'product'    => new ParentProductResource($this->product),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
