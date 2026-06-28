<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->generateTree($this);

    }

    public function generateTree( $category): array
    {

        if ($category->childrenCategories) {

            $item = [

                'id' => $category->id,

                'name' => $category->name,

                'description' => $category->description,

                'parent_id' => $category->parent_id,
                'position' => $category->position,


            ];

            /** @var ListingCategory $value */

            foreach ($category->childrenCategories as $value) {

                $item['children'][] = $this->generateTree($value);

            }

            return $item;

        }

 

        return [

            'id' => $category->id,

            'name' => $category->name,

            'description' => $category->description,

            'parent_id' => $category->parent_id,
            'position' => $category->position,

        ];

    }
}
