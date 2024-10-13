<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'stock',
        'fecha_vencimiento',
        'id_categoria',
    ];

    // Relación con la categoría (opcional)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
