<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            //
            'title_ar'=>'required',
            'title_en'=>'required',
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'presentage'=>'required',
            'price'=>'required',
            'image'=>'nullable|image',
            'back_image'=>'nullable|image'
        ];

        // if($this->route('offers')){
        //     $rules['image'] ='required|image';
        //     $rules['back_image']='required|image';

        // }else{

        //     $rules['image'] ='nullable|image';
        //     $rules['back_image']='nullable|image';
        // }

        return $rules;
    }
}
