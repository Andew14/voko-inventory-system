<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\InventoryMovementService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3018MostrarErrorStockInsuficienteTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-018
    public function test_mostrar_error_stock_insuficiente()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 25]);
        $service = app(InventoryMovementService::class);

        // Act
        try {
            $service->createMovement([
                'product_id' => 3,
                'type' => 'salida',
                'quantity' => 100
            ], $user->id);
            $this->fail('Se esperaba excepcion.');
        } catch (ValidationException $e) {
            // Assert
            $errors = $e->validator->errors()->messages();
            $this->assertArrayHasKey('quantity', $errors);
            $this->assertStringContainsString('Stock insuficiente', $errors['quantity'][0]);
        }
    }
}
