<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryMovementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['entrada', 'salida']),
            'quantity' => fake()->numberBetween(1, 20),
            'observations' => fake()->sentence(),
        ];
    }
}
