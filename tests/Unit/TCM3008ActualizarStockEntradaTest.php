<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3008ActualizarStockEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-008
    public function test_actualizar_stock_entrada()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 20]);
        $service = app(InventoryMovementService::class);

        // Act
        $service->createMovement([
            'product_id' => 3,
            'type' => 'entrada',
            'quantity' => 10
        ], $user->id);

        // Assert
        $this->assertEquals(30, $product->fresh()->stock);
    }
}
