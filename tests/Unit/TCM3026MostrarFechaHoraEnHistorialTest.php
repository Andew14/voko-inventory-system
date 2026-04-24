<?php

namespace Tests\Unit;

use App\Models\InventoryMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3026MostrarFechaHoraEnHistorialTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-026
    public function test_mostrar_fecha_hora_en_historial()
    {
        // Arrange
        $user = User::factory()->create();
        $date = now();
        InventoryMovement::factory()->create(['id' => 101, 'user_id' => $user->id, 'created_at' => $date]);

        // Act
        $response = $this->actingAs($user)->get(route('dashboard'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($date->format('d/m/Y H:i'));
    }
}
