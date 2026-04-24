<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3003ValidarCantidadEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-003
    public function test_validar_cantidad_entrada_cero()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Act
        $response = $this->actingAs($user)->postJson(route('movements.store'), [
            'product_id' => $product->id,
            'type' => 'entrada',
            'quantity' => 0
        ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['quantity']);
    }
}
