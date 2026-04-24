<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3012ValidarCantidadSalidaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-012
    public function test_validar_cantidad_salida_permitida()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 20]);
        $service = app(InventoryMovementService::class);

        // Act
        $movement = $service->createMovement([
            'product_id' => $product->id,
            'type' => 'salida',
            'quantity' => 5
        ], $user->id);

        // Assert
        $this->assertNotNull($movement);
        $this->assertEquals(15, $product->fresh()->stock);
    }
}
