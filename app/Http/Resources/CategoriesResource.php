<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
            'desc'=>$request->header('lang') =='en' ? $this->desc_en : $this->desc_ar ,
        ];
    }
}
