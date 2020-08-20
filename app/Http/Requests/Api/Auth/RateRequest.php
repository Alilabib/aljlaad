<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            'order_id'=>'required|exists:orders,id',
            'rate'=>'required|numeric',
            'description'=>'nullable',
            'driver_rate'=>'required|numeric',
            'driver'=>'required',
            'date_rate'=>'required',
            'date'=>'required'
        ];
    }
}
