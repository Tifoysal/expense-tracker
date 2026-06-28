<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentProductResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'brand' => optional($this->brand)->name,
            'generic' => optional($this->generic)->name,
            'type' => optional($this->type)->name,
            'category' => optional($this->category)->name,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'product_variants'=> ApiProductVariantResource::collection($this->productVariants),
            'primary_image' => $this->image,
            'image' => $this->productImages,
        ];
    }
}
