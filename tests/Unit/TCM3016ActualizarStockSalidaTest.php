<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3016ActualizarStockSalidaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-016
    public function test_actualizar_stock_salida()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 30]);
        $service = app(InventoryMovementService::class);

        // Act
        $service->createMovement([
            'product_id' => 3,
            'type' => 'salida',
            'quantity' => 5
        ], $user->id);

        // Assert
        $this->assertEquals(25, $product->fresh()->stock);
    }
}
