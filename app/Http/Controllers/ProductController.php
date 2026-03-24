<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        public ProductService $productService
    ) {}

    /**
     * Show the products list with dummy data.
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $search = $request->input('search');
        
        $query = Product::with('category');
        
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        }
        
        $products = $query->paginate($perPage);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('products.partials.table', compact('products'))->render(),
                'links' => $products->appends(['search' => $search])->links()->toHtml()
            ]);
        }

        return view('products.index', [
            'products' => $products,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => \App\Models\Category::all(),
            'distributors' => \App\Models\Distribuidor::all(),
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse    
    {                
        $this->productService->createProduct($request->validated());

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }
}
