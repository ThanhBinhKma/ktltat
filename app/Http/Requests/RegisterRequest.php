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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:255|min:3',
            'mssv' => 'required|max:255|min:3',
            'birthday' => [
                'max:255',
                'min:3',
                'regex:/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/'
            ],
            'phone' => [
                'required',
                'min:8',
                'max:30',
                'regex:/^[0-9+]+$/',
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'
            ],
        ];
    }

    /**
     * Change name attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'mssv' => __('mssv'),
            'phone' => __('phone')
        ];
    }

    /**
     * Messages of validate
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.required' => __('Phone required fields'),
            'name.required' => __('Name required fields'),
            'birthday.regex' => __('The date is not in the correct format '),
            'password.regex' => __('The password is not in the correct format ')
        ];
    }



}
