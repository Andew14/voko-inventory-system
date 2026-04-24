<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Ildefonso Sotelo, Andrew Roy
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'stock',
    ];

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
