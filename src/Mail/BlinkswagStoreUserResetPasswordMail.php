<?php

namespace Blinkswag\Store\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlinkswagStoreUserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $title;
    public $unique_token;

    public function __construct( $title, $unique_token)
    {
        $this->title = $title;
        $this->unique_token = $unique_token;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('blinkswag_store_emails.blinkswagstore_usersetpasswordmail')->subject("Reset Password");
    }
}
