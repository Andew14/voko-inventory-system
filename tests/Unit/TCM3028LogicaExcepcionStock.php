<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

/**
 * Pruebas unitarias para la lógica del Módulo 3
 * @author Ildefonso Sotelo, Andrew Roy
 */
class InventoryLogicTest extends TestCase
{
    // RefreshDatabase ejecuta las migraciones en la BD temporal antes de probar
    use RefreshDatabase;

    /**
     * Prueba PU-M3-001: El sistema debe lanzar una excepción si la salida supera el stock.
     */
    public function test_salida_falla_si_excede_el_stock_actual()
    {
        // 1. Preparación (Arrange)
        // Creamos un producto con 10 unidades
        $product = Product::create([
            'name' => 'Memoria RAM 16GB',
            'sku' => 'RAM-016',
            'stock' => 10 
        ]);

        $service = new InventoryMovementService();

        $payload = [
            'product_id' => $product->id,
            'type' => 'salida',
            'quantity' => 15, // Intentamos sacar 15 (más de lo que hay)
            'observations' => 'Prueba de estrés de stock negativo'
        ];

        $userId = 1;

        // 2. Acción y Verificación (Act & Assert)
        // Le decimos a PHPUnit que ESPERAMOS que el código aborte la operación lanzando una Excepción
        $this->expectException(ValidationException::class);
        
        // Al ejecutar esto, el InventoryMovementService debe detenerse en la validación
        $service->createMovement($payload, $userId);

        // Si la excepción no se lanzara (es decir, si el sistema tuviera un fallo y dejara pasar el movimiento),
        // el código llegaría a esta línea y fallaría, demostrando que encontramos un bug.
    }
}