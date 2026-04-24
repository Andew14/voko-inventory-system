<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3002ObtenerProductosActivosTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-002
    public function test_obtener_productos_activos()
    {
        // Arrange
        Product::factory()->create(['status' => 'activo']);
        Product::factory()->create(['status' => 'inactivo']);

        // Act
        // Asumiendo que listamos productos activos
        $productosActivos = Product::where('status', 'activo')->get();

        // Assert
        $this->assertCount(1, $productosActivos);
        $this->assertEquals('activo', $productosActivos->first()->status);
    }
}
