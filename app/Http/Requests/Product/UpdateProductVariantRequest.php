<?php

namespace App\Http\Requests\Product;

use App\Models\ProductVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'size' => [
                'required', 
                Rule::in(ProductVariant::$sizeAvailability)
            ],
            'color' => [
                'required', 
                Rule::in(ProductVariant::$colorAvailability),
                Rule::unique('product_variants', 'color')->where(function ($query) {
                    return $query->where('product_id', $this->product->id)->where('size', $this->size);
                })->ignore($this->variant->id),
            ],
            'stock' => ['required', 'numeric', 'gte:0'],
        ];
    }

    /**
     * Customize the error messages prompting if the variant with such attributes already exists.
     */
    public function messages()
    {
        return [
            'color.unique' => 'A variant with combination of size ' . $this->size . ' and color ' . $this->color . ' already exists.',
        ];
    }
}
