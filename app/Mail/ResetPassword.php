<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected  $newPassword;

    /**
     * Create a new message instance.
     *
     * @param string $newPassword
     */
    public function __construct(string $password)
    {
        $this->newPassword = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reset Password")
                    ->markdown('email.reset.password')
                    ->with(array("newPassword" => $this->newPassword));
    }
}
