<?php

namespace Tests\Unit;

use App\Models\InventoryMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TCM3027MostrarCantidadTipoEnHistorialTest extends TestCase
{
    use RefreshDatabase;

    // Caso de Prueba: TC-M3-027
    public function test_mostrar_cantidad_tipo_en_historial()
    {
        // Arrange
        $user = User::factory()->create();
        InventoryMovement::factory()->create(['id' => 101, 'user_id' => $user->id, 'quantity' => 5, 'type' => 'salida']);

        // Act
        $response = $this->actingAs($user)->get(route('dashboard'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee('+5');     // Cantidad mostrada en la tabla (blade tiene +5 para saldo, o asume layout)
        $response->assertSee('Salida'); // Etiqueta del tipo "Salida ↘"
    }
}
