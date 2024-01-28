<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageGoogle extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("ingenieurdonatien1@gmail.com")
                    ->subject("Ingenieur Donatien.infos")
                    ->view('emails.message-google')
                    ->attach(
                        storage_path('app/public/uploads/imprimante.png'));
    }
}
