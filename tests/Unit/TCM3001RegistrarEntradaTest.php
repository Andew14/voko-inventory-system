<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3001RegistrarEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-001
    public function test_registrar_entrada()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 0]);
        $service = app(InventoryMovementService::class);

        // Act
        $service->createMovement([
            'product_id' => 3,
            'type' => 'entrada',
            'quantity' => 10,
            'observations' => 'Reposición de stock'
        ], $user->id);

        // Assert
        $this->assertDatabaseHas('inventory_movements', [
            'product_id' => 3,
            'quantity' => 10,
            'type' => 'entrada',
            'observations' => 'Reposición de stock'
        ]);
        $this->assertTrue(true); // Resultado esperado True
    }
}
