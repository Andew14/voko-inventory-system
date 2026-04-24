<?php

namespace Tests\Unit;

use App\Models\InventoryMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3023FiltrarHistorialPorFechaTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-023
    public function test_filtrar_historial_por_fecha()
    {
        // Arrange
        InventoryMovement::factory()->create(['created_at' => '2026-05-21 10:00:00']);
        InventoryMovement::factory()->create(['created_at' => '2026-06-01 10:00:00']);

        // Act
        $movimientos = InventoryMovement::whereDate('created_at', '2026-05-21')->get();

        // Assert
        $this->assertCount(1, $movimientos);
        $this->assertEquals('2026-05-21', $movimientos->first()->created_at->format('Y-m-d'));
    }
}
