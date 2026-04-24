<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3020ConsultarHistorialMovimientosAdminTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-020
    public function test_consultar_historial_movimientos_admin()
    {
        // Arrange
        $admin = User::factory()->create(['role' => 'administrador']);

        // Act
        $response = $this->actingAs($admin)->get(route('dashboard'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee('Movimientos');
    }
}
