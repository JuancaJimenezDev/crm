<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'user_id', 'cliente_id', 'fecha_venta', 'pago_id', 'subtotal', 'gran_total',
    ];

    // Relación con el usuario que realiza la venta
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación con los detalles de la venta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

    // Relación con el método de pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }
}
