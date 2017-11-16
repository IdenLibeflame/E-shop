<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $email;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('emails.userMessage', compact('data'));
    }
}
