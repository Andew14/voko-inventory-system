<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->unique()->lexify('SKU-????')),
            'stock' => fake()->numberBetween(10, 100),
            'status' => 'activo',
        ];
    }
}
