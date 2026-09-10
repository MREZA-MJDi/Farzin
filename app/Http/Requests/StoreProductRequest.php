<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:products,slug',
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
                'unique:products,sku',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:100',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'integer',
                'min:0',
            ],

            'old_price' => [
                'nullable',
                'integer',
                'gte:price',
            ],

            'discount' => [
                'nullable',
                'integer',
                'between:0,100',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'rating' => [
                'nullable',
                'numeric',
                'between:0,5',
            ],

            'review_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],

            'is_featured' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}
