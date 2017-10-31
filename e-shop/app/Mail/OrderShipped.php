<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;

    /**
     * Create a new message instance.
     *
     * @param $orderData
     */
    public function __construct($orderData)
    {
        $this->orderData = $orderData;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('basket.orderShipped', compact('orderData'));
    }
}
