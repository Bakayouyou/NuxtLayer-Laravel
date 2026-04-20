<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'    => ['sometimes', 'nullable', 'string', 'max:255'],
            'category'  => ['sometimes', 'nullable', 'string', 'max:100'],
            'minPrice'  => ['sometimes', 'nullable', 'integer', 'min:0'],
            'maxPrice'  => ['sometimes', 'nullable', 'integer', 'min:0'],
            'minRating' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:5'],
            'inStock'   => ['sometimes', 'nullable', 'boolean'],
        ];
    }
}

