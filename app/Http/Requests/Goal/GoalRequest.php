<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;

class GoalRequest extends FormRequest
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
            //
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'first_range'=>'required',
            'second_range'=>'required|gte:first_range',
            'last_range'=>'required|gte:second_range'
        ];
    }
}
