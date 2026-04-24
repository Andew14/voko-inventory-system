<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3009MostrarStockActualizadoTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-009
    public function test_mostrar_stock_actualizado()
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

        // Obtenemos del endpoint
        $response = $this->actingAs($user)->getJson(route('products.show', $product->id));

        // Assert
        $response->assertStatus(200);
        $response->assertJsonPath('stock', 30);
    }
}
