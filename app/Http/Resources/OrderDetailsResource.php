<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'status'=>$this->status,
            'prodvider'=> $this->driver_id ?  new ProviderResource(\App\Models\User::find($this->driver_id)) : $this->driver_id,
            'products'=>OrderProductResource::collection($this->products),
            'sub_total'=>$this->sub_total,
            'delivery_price'=>10,
            'tax'=>75,
            'total'=>$this->total,
            

        ];
    }
}
