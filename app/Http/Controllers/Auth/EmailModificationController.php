<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\EmailModification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailModificationController extends Controller
{
    /**
     * メールアドレス変更画面表示
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        return view('auth.email.modify');
    }

    /**
     * メールアドレス認証メール送信
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        $this->sendEmailValidate($request);

        // 登録データにログイン中ユーザIDをセット
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;

        DB::beginTransaction();
        $email_modification = EmailModification::build($data);

        try {
            // 認証用メール送信
            Mail::to($request->email)->send(new \App\Mail\EmailModification($email_modification));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error("メール送信に失敗しました。 {$e->getMessage()}", $e->getTrace());
            return redirect()->back()->withErrors(['error' => '登録に失敗しました。']);
        }
        return $this->afterSentEmail();
    }

    /**
     * Emailバリデーション
     *
     * @param Request $request
     * @return void
     */
    protected function sendEmailValidate(Request $request)
    {
        return $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
        ]);
    }

    /**
     * Emailバリデーション
     *
     * @param Request $request
     * @return void
     */
    protected function afterSentEmail()
    {
        return redirect()->back()->with('flash_info', "新しいメールアドレスに確認用メールを送信しました。\nメール本文のURLから変更を完了してください。");
    }
}
