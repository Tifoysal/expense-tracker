<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id,
            'first_name'=>$this->first_name??$this->name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'role'=>$this->role_id?strtolower($this->role->name):$this->type,
            'token'=>$this->token,
            'phone'=>$this->phone,
            'image'=>$this->image,
            'device_token'=>$this->device_token,
            'checkin'=>true,
        ];
    }
}
