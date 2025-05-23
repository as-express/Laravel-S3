<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
        return [
            'name' => 'nullable|required|string',
            'image' => ['nullable', 'image', 'max:4096'],
            'description' => 'nullable|required|string',
            'price' => 'nullable|required|integer',
            'stock' => 'nullable|required|integer',
        ];
    }
}
