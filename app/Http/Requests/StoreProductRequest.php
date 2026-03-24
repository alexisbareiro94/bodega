<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {        
        return true; // We assume the route is protected by auth middleware
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'barcode' => ['nullable', 'string', 'max:50', 'unique:products,barcode'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'distributor_id' => ['nullable', 'integer', 'exists:distributors,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'stock_min' => ['nullable', 'integer', 'min:0'],
            'iva' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }        

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {        
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'price.required' => 'El precio de venta es obligatorio.',
            'cost.required' => 'El costo de compra es obligatorio.',
            'stock.required' => 'El nivel de stock es obligatorio.',
            'barcode.unique' => 'El código de barras ya está registrado en otro producto.',
            'image.image' => 'El archivo debe ser una imagen válida.',
            'image.max' => 'La imagen no debe superar los 2MB.',
            
        ];
    }
}
