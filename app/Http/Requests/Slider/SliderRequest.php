<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        return [
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'nullable',
            'desc_en'=>'nullable',
            'image'=>'required',
            'type'=>'required',
            'link'=>'requiredIf:type,link',
            'category_id'=>'requiredIf:type,company'
        ];
    }
}
