<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiniOrderResource extends JsonResource
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
            'created_at'=>$this->created_at->format('Y/m/d'),
            'date'=>$this->date->format('Y/m/d'),
            'total'=>$this->total,
            'status'=>$this->status,
            'product_count'=>$this->products->count()
        ];
    }
}
