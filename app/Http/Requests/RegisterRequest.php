<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * Get the validation rules that apply o the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone' => 'required|min:8|max:13|unique:users,phone',
            'password' => 'required|min:4',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }
}