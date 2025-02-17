<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // data pengguna

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $url = url("/email/verify/{$this->user->id}/" . sha1($this->user->email));

        return $this->subject('Verifikasi Email Anda')
            ->view('emails.verify-email')
            ->with([
                'url' => $url,
                'name' => $this->user->name,
            ]);
    }
}
