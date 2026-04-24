<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class ProductController extends Controller
{
    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'administrador') {
            abort(403, 'No autorizado');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'administrador') {
            abort(403, 'No autorizado');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado.');
    }
}
