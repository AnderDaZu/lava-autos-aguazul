<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $service = $this->route()->parameter('service');
        
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric|min:1000',
            'duration' => 'required',
            'type_id' => 'required|exists:types,id'
        ];

        if ($service) {
            $rules['name'] = "required";
        }

        return $rules;

    }
}
