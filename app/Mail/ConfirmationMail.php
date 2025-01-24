<?php
namespace App\Mail;


use Illuminate\Mail\Mailable;

class ConfirmationMail extends Mailable
{
    public $developer;
    public $verificationUrl;

    public function __construct($developer, $verificationUrl)
    {
        $this->developer = $developer;
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        return $this->view('emails.confirmation')
                ->with(['verificationUrl' => $this->verificationUrl]);
    }
}
