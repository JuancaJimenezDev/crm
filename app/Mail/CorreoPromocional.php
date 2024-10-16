<?php

namespace App\Mail;

use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoPromocional extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    public function build(): CorreoPromocional
    {
        return $this->subject('Promoción en tu producto favorito')
            ->view('emails.promocion');
    }
}
