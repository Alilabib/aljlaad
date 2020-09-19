<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'desc'=> $request->header('lang') =='en' ? $this->desc_en : $this->desc_ar ,
            'image'=> $this->ImageUrl,
            'price'=>$this->price,
            'category_id'=>$this->category->id,
            'category_name'=> $request->header('lang') =='en' ? $this->category->name_en : $this->category->name_ar
        ];
    }
}
