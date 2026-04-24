<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3019MostrarStockAlSeleccionarTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-019
    public function test_mostrar_stock_al_seleccionar()
    {
        // Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['id' => 3, 'stock' => 25]);

        // Act
        $response = $this->actingAs($user)->getJson(route('products.show', $product->id));

        // Assert
        $response->assertStatus(200);
        $response->assertJsonPath('stock', 25);
    }
}
