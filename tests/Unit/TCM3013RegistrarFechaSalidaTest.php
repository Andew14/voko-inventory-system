<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3013RegistrarFechaSalidaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-013
    public function test_registrar_fecha_salida()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 10]);
        $service = app(InventoryMovementService::class);

        // Act
        $movement = $service->createMovement([
            'product_id' => $product->id,
            'type' => 'salida',
            'quantity' => 2
        ], $user->id);

        // Assert
        $this->assertNotNull($movement->created_at);
        $this->assertEquals(now()->format('Y-m-d'), $movement->created_at->format('Y-m-d'));
    }
}
