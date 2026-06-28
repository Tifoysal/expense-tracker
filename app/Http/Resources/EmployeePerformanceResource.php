<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePerformanceResource extends JsonResource
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
            'targets' => [
                'sale' => (float) $this['targets']->sale_target,
                'collection' => (float) $this['targets']->collection_target,
                'status' => $this['targets']->status
            ],
            'actual' => $this['actual'],
            'achievement' => $this['achievement'],
            'period' => $this['period']
        ];
    }
}
