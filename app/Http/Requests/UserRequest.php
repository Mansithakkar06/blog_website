<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method=$this->method();
        switch($method){
            case 'POST':
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required|digits:10|unique:users,phone',
            'image' => 'required|mimes:png,jpg',
            'status' => 'required',
        ];
        case 'PUT':
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'required',
            'phone' => 'required|digits:10|unique:users,phone,'.$this->id,
            'image' => 'required|mimes:png,jpg',
            'status' => 'required',
        ];
    }
    }
}
