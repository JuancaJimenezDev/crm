<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    // Asegúrate de que el modelo esté conectado con la tabla correcta
    protected $table = 'pagos';

    // Campos que son asignables en masa
    protected $fillable = [
        'metodo_pago',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'pago_id');
    }
}
