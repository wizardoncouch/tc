<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'slug' => 'required|string|regex:/^[a-zA-Z0-9]+$/|unique:main.clients,slug',
            'name' => 'required|string',
            'email' => 'required|email'
        ];
    }
}
