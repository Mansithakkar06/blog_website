<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $method = $this->method();
        switch ($method) {
            case "POST":
                return [
                    'name' => 'required',
                    'image' => 'sometimes|mimes:png,jpg',
                    'status' => 'required',
                ];
            case "PUT":
                return [
                    'name' => 'required',
                    'image' => 'sometimes|mimes:png,jpg',
                    'status' => 'required',
                ];
        }
    }
}
