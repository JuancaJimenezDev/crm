<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'product_id', 'stock', 'added_by', 'updated_by',
    ];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }

    // Relación con el usuario que agregó el producto
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relación con el usuario que actualizó el producto
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
