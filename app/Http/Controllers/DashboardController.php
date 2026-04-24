<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryMovement;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        // Eager Loading for N+1 optimization
        $latestMovements = InventoryMovement::with(['product', 'user'])->latest()->take(10)->get();

        return view('dashboard', compact('totalProducts', 'totalStock', 'latestMovements'));
    }
}
