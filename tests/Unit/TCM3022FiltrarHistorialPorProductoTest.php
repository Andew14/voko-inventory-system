<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\InventoryMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3022FiltrarHistorialPorProductoTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-022
    public function test_filtrar_historial_por_producto()
    {
        // Arrange
        Product::factory()->create(['id' => 3]);
        Product::factory()->create(['id' => 4]);
        
        InventoryMovement::factory()->create(['product_id' => 3]);
        InventoryMovement::factory()->create(['product_id' => 4]);

        // Act
        $movimientos = InventoryMovement::where('product_id', 3)->get();

        // Assert
        $this->assertCount(1, $movimientos);
        $this->assertEquals(3, $movimientos->first()->product_id);
    }
}
