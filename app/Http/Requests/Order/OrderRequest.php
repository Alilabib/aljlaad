<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id'=>'required|exists:users,id',
            'driver_id'=>'required|exists:users,id',
            'date'=>'required|date|after:yesterday',
            'time'=>'required',
            'payment_type'=>'required',
            'items'=>'required|array',
            'items.*'=>'required|exists:products,id',
            'quantity'=>'required|array',
            'quantity.*'=>'required|numeric|min:0',
        ];
    }
}
