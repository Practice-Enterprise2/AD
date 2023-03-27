<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class shipmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public function build()
    {
        return $this->view('shipment')
                    ->subject('Welcome to My Website')
                    ->with([
                        'name' => 'John Doe',
                        'email' => 'killian.serluppens@gmail.com',
                    ]);
    }
}
