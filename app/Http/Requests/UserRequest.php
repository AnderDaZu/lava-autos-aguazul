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
        $year = date("Y", strtotime(now('Y')."- 15 years"));
        $rules = [
            'user_name' => 'required|unique:users',
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:$year-12-31",
            'identification' => 'required|unique:users',
            'phone' => 'required|min:10|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'state_id' => 'required|exists:states,id'
        ];

        return $rules;
    }
}
