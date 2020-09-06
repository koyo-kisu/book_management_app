<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCancelMail extends Mailable
{
    use Queueable, SerializesModels;

    private $_admins;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->_admins = \App\Admin::all('email');
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = $this->_admins->pluck('email');
        return $this->subject('【予約キャンセル】')->to($to)->view('mail.bookings.cancel');
    }
}
