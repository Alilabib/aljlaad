<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' =>$this->name,
            'email'=>$this->email,
            'token'=>$this->token->jwt,
            'phone'=>$this->phone,
            'image'=>$this->ImageUrl,
            'total_review'=>$this->total_review,
            'city'=>$this->city->name_ar,
            'type'=>$this->type
        ];
    }
}
