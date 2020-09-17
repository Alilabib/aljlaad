<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
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
            'step1'=>$this->first_range,
            'step2'=>$this->second_range,
            'step3'=>$this->last_range,
            'userCount'=>getProductCountByUserId(auth()->user()->id, $this->product_id),
            'product'=>$this->product_id != null ? new ProductsResource($this->product) : null,

        ];
    }
}
