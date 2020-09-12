<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // 認証用URL発行
        $route = route('register.verify');
        $this->link = $route . "?id={$user['id']}&token={$user['token']}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO: メール内容。件名、本文
        return $this->subject('【メールアドレス認証のご案内】仮登録ありがとうございます。URLより、認証を完了してください。')->view('mail.auth.registered');
    }
}
