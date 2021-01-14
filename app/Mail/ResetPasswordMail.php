<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $psw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario, $passwd)
    {
        $this->usuario = $usuario;
        $this->psw = $passwd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reset-password');
    }
}
