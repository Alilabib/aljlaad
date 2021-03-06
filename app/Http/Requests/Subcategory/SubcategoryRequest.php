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
            'category_id'=>'required|exists:categories,id'
        ];

        return $rules;
    }
}
