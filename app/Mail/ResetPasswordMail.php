<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $token)
    {
        $this->resetLink = url("/reset-password/{$token}?email=" . urlencode($user->email));
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Reset Password Link')
            ->view('emails.reset-password');
    }
}
