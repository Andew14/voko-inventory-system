<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3014RegistrarMotivoSalidaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-014
    public function test_registrar_motivo_salida()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 10]);
        $service = app(InventoryMovementService::class);
        $motivo = "Venta al cliente";

        // Act
        $movement = $service->createMovement([
            'product_id' => $product->id,
            'type' => 'salida',
            'quantity' => 1,
            'observations' => $motivo
        ], $user->id);

        // Assert
        $this->assertEquals($motivo, $movement->observations);
        $this->assertDatabaseHas('inventory_movements', ['observations' => $motivo, 'type' => 'salida']);
    }
}
