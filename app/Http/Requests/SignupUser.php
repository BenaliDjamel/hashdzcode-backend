<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUser extends FormRequest
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

    public function rules()
    {
        return [
            "email" => "required|email|unique:users",
            "firstname" => "required|string|min:3|max:10",
            "lastname" => "required|string|min:3|max:10",
            "password"=>"required|confirmed|min:6",
        ];
    }

    public function messages()
{
    return [
        'email.required' => 'A email is required.',
        'email.unique' => 'The email already exist.',
        'firstname.unique' => 'A first name is required.',
        'firstname.min' => 'A first name should be more than 2 characters.',
        'firstname.max' => 'A first name should be less than or equals 10 characters.',
        'lastname.unique' => 'A last name is required.',
        'lastname.min' => 'A last name should be more than 2 characters.',
        'lastname.max' => 'A last name should be less than or equals 10 characters.',
        'password.required' => 'A password is required.',
        'password.min' => 'A password should be more than 5 characters.',
        

    ];
}
}
