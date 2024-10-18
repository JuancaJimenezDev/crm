<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class CorreoPromocional extends Mailable
{
    use Queueable, SerializesModels;

    public $productos;

    public function __construct(Collection $productos)
    {
        $this->productos = $productos;
    }

    public function build()
    {
        return $this->subject('Promociones en tus productos favoritos')
            ->view('emails.promocion', ['productos' => $this->productos]);
    }
}
