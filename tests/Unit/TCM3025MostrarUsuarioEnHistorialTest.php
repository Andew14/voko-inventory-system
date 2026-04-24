<?php

namespace Tests\Unit;

use App\Models\InventoryMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3025MostrarUsuarioEnHistorialTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-025
    public function test_mostrar_usuario_en_historial()
    {
        // Arrange
        $user = User::factory()->create(['name' => 'El Operador']);
        InventoryMovement::factory()->create(['id' => 101, 'user_id' => $user->id]);

        // Act
        $response = $this->actingAs($user)->get(route('dashboard'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee('El Operador');
    }
}
