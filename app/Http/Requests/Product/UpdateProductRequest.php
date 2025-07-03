<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('products', 'name')->where(function ($query) {
                    return $query->where('category_id', $this->category_id);
                })->ignore($this->product->id)
            ],
            'category_id' => ['required'],
            'description' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:0,1000000000'],
            'discount_percentage' => ['required', 'numeric', 'between:0,99'],
        ];
    }

    /**
     * Customize the error messages prompting if the product with such attributes already exists.
     */
    public function messages()
    {
        return [
            'name.unique' => 'A product with name ' . $this->name . ' already exists for category ' . Category::where('id', $this->category_id)->first()->name . '.',
        ];
    }
}
