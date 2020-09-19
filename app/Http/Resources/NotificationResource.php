<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'title'=> $request->header('lang') =='en' ? $this->title_en: $this->title_ar,
            'content'=>$this->value_ar,
            'order_id'=>$this->order_id,
            'updated_at'=>$this->updated_at->diffForHumans(),
        ];
    }
}
