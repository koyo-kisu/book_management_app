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
        $app_url = config('app.url');
        $id = $user['id'];
        $token = $user['token'];
        $this->link = "{$app_url}/register/verify/{$id}/{$token}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO: メール内容。件名、本文
        return $this->subject('【本登録のご案内】仮登録ありがとうございます。URLより、本登録をお願いします。')->view('mail.auth.registered');
    }
}
