<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3007RegistrarUsuarioResponsableEntradaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-007
    public function test_registrar_usuario_responsable_entrada()
    {
        // Arrange
        $user = User::factory()->create(['id' => 2]);
        $product = Product::factory()->create();

        // Act
        $response = $this->actingAs($user)->postJson(route('movements.store'), [
            'product_id' => $product->id,
            'type' => 'entrada',
            'quantity' => 5
        ]);

        // Assert
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('inventory_movements', ['user_id' => 2, 'type' => 'entrada']);
    }
}
