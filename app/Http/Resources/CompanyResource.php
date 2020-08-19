<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name'=>$this->name_ar,
            'desc'=>$this->desc_ar,
            'image'=>$this->ImageUrl,
            'back_image'=>$this->BackImageUrl,
            'mini_cost'=>$this->min,
            'total_review'=>$this->total_review,
            'fav'=> auth()->user() ? checkFavourite(auth()->user()->id,$this->id) : false,
        ];
    }
}
