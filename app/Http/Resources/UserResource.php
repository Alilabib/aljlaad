<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id,
            'name' =>$this->name,
            'email'=>$this->email,
            'token'=> $this->token ? $this->token->jwt  : $this->token,
            'phone'=>$this->phone,
            'image'=>$this->ImageUrl,
            'city_id'=>$this->city_id,
            'city_name'=>$this->city_id ? $request->header('lang') =='en' ? $this->city->name_en  : $this->city->name_ar : $this->city_id,
            'address'=>$this->address,
            'dob'=>$this->active_code,
            'gender'=>$this->type
        ];
    }
}
