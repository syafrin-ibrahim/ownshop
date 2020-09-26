<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|min:5|max:20',
            'roles' => 'required',
            'address' => 'required|min:29|max:200',
            'password' => 'required',
            'password_confirmation' =>'required|same:password',
            'phone' => 'required|string'
            
        ];
    }
}
