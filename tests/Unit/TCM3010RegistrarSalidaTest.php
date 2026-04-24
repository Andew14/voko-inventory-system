<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3010RegistrarSalidaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-010
    public function test_registrar_salida()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 10]);
        $service = app(InventoryMovementService::class);

        // Act
        $service->createMovement([
            'product_id' => 3,
            'type' => 'salida',
            'quantity' => 5,
            'observations' => 'Despacho cliente'
        ], $user->id);

        // Assert
        $this->assertDatabaseHas('inventory_movements', [
            'product_id' => 3,
            'quantity' => 5,
            'type' => 'salida',
            'observations' => 'Despacho cliente'
        ]);
        $this->assertEquals(5, $product->fresh()->stock);
    }
}
