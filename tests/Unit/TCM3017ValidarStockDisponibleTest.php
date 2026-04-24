<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3017ValidarStockDisponibleTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-017
    public function test_validar_stock_disponible()
    {
        // Arrange
        $this->expectException(ValidationException::class);
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 25]);
        $service = app(InventoryMovementService::class);

        // Act (Bloqueado)
        $service->createMovement([
            'product_id' => 3,
            'type' => 'salida',
            'quantity' => 100
        ], $user->id);

        // Assert no se define abajo por expectException
    }
}
