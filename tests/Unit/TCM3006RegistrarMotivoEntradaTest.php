<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3006RegistrarMotivoEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-006
    public function test_registrar_motivo_entrada()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $service = app(InventoryMovementService::class);
        $motivo = "Compra a proveedor";

        // Act
        $movement = $service->createMovement([
            'product_id' => $product->id,
            'type' => 'entrada',
            'quantity' => 10,
            'observations' => $motivo
        ], $user->id);

        // Assert
        $this->assertEquals($motivo, $movement->observations);
        $this->assertDatabaseHas('inventory_movements', ['observations' => $motivo]);
    }
}
