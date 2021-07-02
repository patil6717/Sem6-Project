<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class otpmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   
    public function __construct($odata)
    {
        $this->ootpdata=$odata;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $this->from("yogeshpatil6717@gmail.com")->subject('Otp For Booking')->view('ootpmail', ['maildata' => $this->ootpdata]);
    }
}
