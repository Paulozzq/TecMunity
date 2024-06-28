<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        
    }

    public function build()
    {
        $address = 'tecmunity@gmail.com';
        $subject = 'Verificación de correo electrónico';
        $name = 'TecMunity';

        return $this->view('emails.test')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([
                        'test_message' => $this->data['message'],
                        'verification_link' => $this->data['verification_link'],
                        'user_name' => $this->data['user_name'], // Asegúrate de pasar el nombre del usuario
                    ]);
    }
}

?>
