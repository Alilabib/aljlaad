<?php

namespace App\Http\Requests\Subcategory;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
        $rules= [
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'nullable',
            'desc_en'=>'nullable',
            'city_id'=>'required|exists:cities,id',
            'express_delivery'=>'required',
            'category_id'=>'required|exists:categories,id',
            'back_image'=>'required',
            'min'=>'required',
        ];
        if ($this->route('subcategory')){
            $rules['image']='sometimes|image';
        }else{
            $rules['image']='required|image';
        }
        if ($this->route('subcategory')){
            $rules['back_image']='sometimes|image';
        }else{
            $rules['back_image']='required|image';
        }
        return $rules;
    }
}
