<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class MiniProviderOrderResource extends JsonResource
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
            'username'=>$this->user_id ?  $this->user->name : $this->user_id, 
            'total'=>$this->total,
            'product_count'=>$this->products->count(),
            'date'=>date_format($this->date,'d-m-Y') ,
            'address'=>$this->user_id ?  $request->header('lang') =='en' ?  $this->user->area->city->name_en :  $this->user->area->city->name_ar.','. $request->header('lang') =='en' ? $this->user->area->name_en : $this->user->area->name_ar : $this->user_id
        ];
        
    }
}
