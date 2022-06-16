<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string |max:50',
            'file' => 'required|image',
            'extract' => 'required|min:20',
            'body' => 'required|min:50',
            'service_id' => 'required|exists:services,id',
        ];
        return $rules;
    }
}
