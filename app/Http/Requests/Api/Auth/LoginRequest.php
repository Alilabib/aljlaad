<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name'=>'Required|exists:users,name',
            'password'=>'Required'
        ];
    }

    // public function messages()
    // {
    //   return  [
    //         'mobile.required'=>'Please Enter Your user Number or Email',
    //         'password.required'=>'Please Enter Your passwrod'
    //     ];
    // }
}
