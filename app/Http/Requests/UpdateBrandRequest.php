<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'brand_name' => 'sometimes|required|string|max:255',
            'brand_image' => 'sometimes|required|url|max:2048',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'country_code' => 'sometimes|required|string|size:2',
        ];
    }
}
