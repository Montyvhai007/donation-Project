<?php
namespace App\Mail;

use App\Models\Developer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;


class ConfirmationMail extends Mailable
{
    use SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user; // Assign user object to the public property
    }

    public function build()
    {
        return $this->view('emails.confirmation')
                    ->with([
                        'name' => $this->user->name, // Pass the name explicitly to the view
                        'confirmationUrl' => url("/email/verify/{$this->user->id}/{$this->user->verification_token}"),
                    ]);
    }
}
