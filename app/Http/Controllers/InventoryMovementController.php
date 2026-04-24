<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreInventoryMovementRequest;
use App\Services\InventoryMovementService;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class InventoryMovementController extends Controller
{
    protected InventoryMovementService $service;

    public function __construct(InventoryMovementService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $products = Product::all();
        return view('movements.create', compact('products'));
    }

    public function store(StoreInventoryMovementRequest $request)
    {
        $this->service->createMovement($request->validated(), auth()->id());
        return redirect()->route('dashboard')->with('success', 'Movimiento registrado correctamente.');
    }
}
