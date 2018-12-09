<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        if($this->has('approve')){
            return [
                'id' => 'required|integer|exists:main.users,id'
            ];
        } else {
            $array = [
                'id' => 'required|integer|exists:main.users,id',
                'name' => 'required|string',
                'email' => 'required|email|unique:main.users,email,' . $this->get('id'),
                'roles' => 'required'
            ];
            if( $this->has('password') ){
                $array['password'] = 'required|confirmed';
            }
            return $array;
        }
    }
}
