<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mostrar listado de productos con búsqueda, filtros y paginación.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Búsqueda por texto
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(fn($sub) =>
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
            );
        }

        // Filtro por categoría
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filtro por precio
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $categories = Category::orderBy('name')->get();
        $products   = $query->orderBy('name')
                            ->paginate(12)
                            ->appends($request->all());

        return view('products.index', compact('products','categories'));
    }

    /**
     * Detalle de un producto.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
