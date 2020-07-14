<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProductsResource extends JsonResource
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
            'id'=>$this->product_id,
            'quantity'=>$this->quantity,
            'image'=> $this->ImageUrl,
            'price'=>$this->price,
        ];
    }
}
