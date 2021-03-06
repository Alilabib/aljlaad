<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'name'=>$request->header('lang') =='en' ? $this->name_en : $this->name_ar,
            'quantity'=>$this->pivot->quantity,
            'price'=>$this->price,
            'image'=>$this->ImageURL,
            'min'=>$this->category->min ? $this->category->min : 0 
        ];
    }
}
