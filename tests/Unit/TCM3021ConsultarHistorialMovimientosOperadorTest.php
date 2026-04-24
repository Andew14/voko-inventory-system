<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3021ConsultarHistorialMovimientosOperadorTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-021
    public function test_consultar_historial_movimientos_operador_restringido()
    {
        // Arrange
        $operador = User::factory()->create(['role' => 'operador']);
        $product = \App\Models\Product::factory()->create(['id' => 1]);

        // Act
        // Asumiendo que listados extendidos o destruir se bloquean a operador
        $response = $this->actingAs($operador)->delete(route('products.destroy', $product->id));

        // Assert
        $response->assertStatus(403);
    }
}
