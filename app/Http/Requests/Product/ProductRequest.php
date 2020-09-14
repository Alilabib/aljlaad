<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'category_id'=>'required|exists:categories,id',
            'price'  =>'required',
        ];

        if ($this->route('product')){
            $rules['image']='sometimes|image';

        }else{
            $rules['image']='required|image';

        }
        return $rules;

    }
}
