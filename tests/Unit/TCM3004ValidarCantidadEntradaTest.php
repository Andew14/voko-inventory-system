<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3004ValidarCantidadEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-004
    public function test_validar_cantidad_entrada_negativa()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Act
        $response = $this->actingAs($user)->postJson(route('movements.store'), [
            'product_id' => $product->id,
            'type' => 'entrada',
            'quantity' => -5
        ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['quantity']);
    }
}
