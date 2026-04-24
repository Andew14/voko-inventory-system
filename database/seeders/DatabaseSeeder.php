<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin VOKO',
            'email' => 'admin@voko.com',
            'password' => Hash::make('password'),
            'role' => 'administrador'
        ]);

        User::create([
            'name' => 'Operador VOKO',
            'email' => 'operador@voko.com',
            'password' => Hash::make('password'),
            'role' => 'operador'
        ]);

        Product::insert([
            ['name' => 'Laptop Dell XPS 13', 'sku' => 'LAP-DELL-XPS13', 'stock' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Monitor LG 27 UltraGear', 'sku' => 'MON-LG-27UG', 'stock' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teclado Mecánico Keychron', 'sku' => 'TEC-KEY-K2', 'stock' => 25, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
