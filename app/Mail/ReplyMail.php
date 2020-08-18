<?php

namespace App\Mail;

use App\Booking;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    private $_users;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->_users = \App\User::where(['email' => $booking->user->email])->toArray();
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = array_column($this->_users, 'email');
            
        return $this->subject('【予約申請】')
                    ->to($to)
                    ->view('mail.reply');
    }
}
