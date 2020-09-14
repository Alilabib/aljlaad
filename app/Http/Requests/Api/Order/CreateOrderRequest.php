<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'date'      =>'required',
            'address_id'=>'required|exists:addresses,id',
            'time'      =>'required',
            'coupoun'   =>'sometimes',
            'pay_type'  =>'required|in:cache,online',
        ];
    }
}
