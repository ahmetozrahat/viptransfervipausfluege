<?php

namespace App\Mail;

use App\Models\TransferOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedAdmin extends Mailable
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
        switch ($this->order->direction) {
            case 1:
                // Two ways
                return $this->subject(trans('mail_order_subject'))->view('emails.order_placed_admin_direction1');
            case 2:
                // From Airport
                return $this->subject(trans('mail_order_subject'))->view('emails.order_placed_admin_direction2');
            case 3:
                // From Hotel
                return $this->subject(trans('mail_order_subject'))->view('emails.order_placed_admin_direction3');
            default:
                // Some error must have been occurred.
                break;
        }
        return $this->subject(trans('mail_order_subject'))->view('emails.order_placed_admin_direction1');
    }
}
