<?php

namespace App\Services;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class InventoryMovementService
{
    /**
     * Registra un movimiento de inventario y actualiza el stock.
     *
     * @param array $data
     * @param int $userId
     * @return InventoryMovement
     * @throws ValidationException
     */
    public function createMovement(array $data, int $userId): InventoryMovement
    {
        return DB::transaction(function () use ($data, $userId) {
            // Se bloquea el registro del producto para evitar lecturas sucias durante transacciones concurrentes
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($data['type'] === 'salida') {
                if ($data['quantity'] > $product->stock) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stock insuficiente para realizar la salida'
                    ]);
                }
                $product->stock -= $data['quantity'];
            } else {
                // Entrada
                $product->stock += $data['quantity'];
            }

            $product->save();

            $movement = InventoryMovement::create([
                'product_id' => $data['product_id'],
                'user_id' => $userId,
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'observations' => $data['observations'] ?? null,
            ]);

            return $movement;
        });
    }
}
