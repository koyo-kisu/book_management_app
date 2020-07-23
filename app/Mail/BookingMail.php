<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $_admins;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_admins = \App\Admin::all('email')->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = array_column($this->_admins, 'email');
        return $this->subject('【予約申請】')->to($to)->view('mail.booking');
    }
}
