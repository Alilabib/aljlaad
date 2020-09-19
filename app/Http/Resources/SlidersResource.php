<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidersResource extends JsonResource
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
            'name'=>$request->header('lang') =='en' ? $this->name_en : $this->name_ar,
            'content'=>$request->header('lang') =='en' ? $this->desc_en : $this->desc_ar,
            'image'=> $this->ImageUrl,
            'type'=>$this->type,
            'link'=>$this->link,
            'company_id'=>$this->company_id
        ];
    }
}
