<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3011ObtenerProductosConStockTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-011
    public function test_obtener_productos_con_stock()
    {
        // Arrange
        Product::factory()->create(['status' => 'activo', 'stock' => 10]);
        Product::factory()->create(['status' => 'activo', 'stock' => 0]);

        // Act
        $productosActivosConStock = Product::where('status', 'activo')->where('stock', '>', 0)->get();

        // Assert
        $this->assertCount(1, $productosActivosConStock);
        $this->assertTrue($productosActivosConStock->first()->stock > 0);
    }
}
