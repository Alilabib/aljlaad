<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'mini_title'=>$this->title_ar,
            'name'=>$this->name_ar,
            'desc'=>$this->desc_ar,
            'price'=>$this->price,
            'image'=>$this->ImageURL,
            'back_img'=>$this->BackImageURL,
            'discount'=>$this->presentage
        ];
    }
}
