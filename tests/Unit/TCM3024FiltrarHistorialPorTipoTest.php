<?php

namespace Tests\Unit;

use App\Models\InventoryMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3024FiltrarHistorialPorTipoTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-024
    public function test_filtrar_historial_por_tipo()
    {
        // Arrange
        InventoryMovement::factory()->create(['type' => 'salida']);
        InventoryMovement::factory()->create(['type' => 'entrada']);

        // Act
        $movimientosSalida = InventoryMovement::where('type', 'salida')->get();

        // Assert
        $this->assertCount(1, $movimientosSalida);
        $this->assertEquals('salida', $movimientosSalida->first()->type);
    }
}
