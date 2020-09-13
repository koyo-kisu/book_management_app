<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailModification extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // 認証用URL発行
        $route = route('email.modify.check');
        $this->link = $route . "?user_id={$data['user_id']}&token={$data['token']}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('【メールアドレス変更のご案内】URLより、メールアドレス変更を完了してください。')->view('mail.auth.email.modify');
    }
}
