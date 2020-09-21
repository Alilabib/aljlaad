<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JWTAuth;
class CompanyResource extends JsonResource
{

 

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // dd($request->bearerToken());
       //$token = $request->header('Authorization');
        try{
            $token = JWTAuth::getToken();
            $user =  JWTAuth::parseToken()->toUser();
        }catch(\Exception $e){
                $user = null;
        }
            // $token = JWTAuth::getToken();
      // $user =  JWTAuth::parseToken()->toUser();
      // $user = $token ?  JWTAuth::toUser($token) : null;
        return [
            'id'=>$this->id,
            'name'=>$request->header('lang') =='en' ? $this->name_en : $this->name_ar,
            'desc'=>$request->header('lang') =='en' ? $this->desc_en : $this->desc_ar,
            'image'=>$this->ImageUrl,
            'back_image'=>$this->BackImageUrl,
            'mini_cost'=>$this->min,
            'total_review'=>$this->total_review,
            'fav'=> $user ? checkFavourite($user->id,$this->id) : false,
            'express'=>$this->express_delivery
        ];
    }
}
