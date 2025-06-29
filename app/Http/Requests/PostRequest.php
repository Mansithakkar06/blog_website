<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            case 'POST':
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'category_id' => 'required|exists:categories,id',
                    'status' => 'required',
                    'image' => 'required|mimes:png,jpg',
                ];
            case 'PUT':
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'category_id' => 'required|exists:categories,id',
                    'status' => 'required',
                    'image' => 'sometimes|mimes:png,jpg',
                ];
        }
    }
}
