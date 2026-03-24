<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Store a new product in the database.
     *
     * @param array<string, mixed> $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {                        
        if (isset($data['image']) && $data['image']) {            
            $fileName = time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('images/products'), $fileName);

            $data['image'] = $fileName;            
        } else {            
            unset($data['image']);
        }
        
        // Generación de SKU automático
        $prefix = 'GEN'; // Por defecto si no hay categoría
        if (!empty($data['category_id'])) {
            $category = \App\Models\Category::find($data['category_id']);
            if ($category) {
                // Tomar las primeras 3 letras, quitar acentos utilizando Str::slug de Laravel
                $cleanName = \Illuminate\Support\Str::slug($category->name, '');
                $prefix = strtoupper(substr($cleanName, 0, 3));
            }
        }
        
        $productCount = Product::count() + 1;
        $data['sku'] = sprintf('%s-%04d', $prefix, $productCount);

        return Product::create($data);
    }
}
