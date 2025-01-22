<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->view('emails.donation_received')
                    ->with([
                        'donationAmount' => $this->donation['amount'],
                        'donorName' => $this->donation['name'],
                    ])
                    ->subject('Thank you for your Donation!');
    }
}
