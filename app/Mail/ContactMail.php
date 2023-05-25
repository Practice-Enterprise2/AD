<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use resources\views\mails\refundMessage;
  
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
   
    public $data = [];
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->from('cptn989@gmail.com')->subject('Refund')->view('mails.refundMessage')->with('data',$this->$data);
    }
}