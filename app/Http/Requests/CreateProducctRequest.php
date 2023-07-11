<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'numeric',
            'description' => 'nullable',
            'image' => 'nullable|file',
            'stocked' => 'nullable|boolean',
            'slug' => 'nullable|string'
        ];
    }
}
