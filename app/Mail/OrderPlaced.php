<?php

namespace App\Mail;

use App\Models\TransferOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\TransferOrder
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\TransferOrder $order
     * @return void
     */
    public function __construct(TransferOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail_order_subject'))->view('emails.order_placed_direction1');
    }
}
