<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'precio', 'en_promocion', 'precio_promocional', 'id_categoria',
    ];

    // Relación con la categoría (opcional)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function promocion()
    {
        return $this->hasMany(Promocion::class);
    }
}
