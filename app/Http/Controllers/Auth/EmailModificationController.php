<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\EmailModification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
     * Email送信後
     *
     * @param Request $request
     * @return void
     */
    protected function afterSentEmail()
    {
        return redirect()->back()->with('flash_info', "新しいメールアドレスに確認用メールを送信しました。\nメール本文のURLから変更を完了してください。");
    }

    /**
     * メール内リンクから認証
     *
     * @param Request $request
     * @return void
     */
    protected function checkModification(Request $request)
    {
        $validator = $this->verifyValidator($request->all());

        // バリデーション失敗時
        if($validator->fails()) {
            return $this->verifyFailed();
        }
        $email_modification = EmailModification::findByIdToken($request->all());
        // データが見つからない場合
        if(empty($email_modification)) {
            return $this->verifyFailed();
        }

        DB::beginTransaction();
        try {
            // ユーザーのアドレスを更新
            User::find($email_modification->user_id)->update(['email' => $email_modification->email]);
            // 変更用情報を削除
            $email_modification->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error("変更に失敗しました。 {$e->getMessage}", $e->getTrace());
            return $this->verifyFailed();
        }
        return redirect()->route('books.index')->with('flash_success', 'メールアドレスの変更が完了しました。');
    }

    /**
     * メールアドレス認証のバリデーション
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function verifyValidator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required'],
            'token' => ['required', 'string'],
        ]);
    }

    /**
     * 認証失敗時
     *
     * @return \Illuminate\Http\Response
     */
    protected function verifyFailed()
    {
        return redirect()->route('email.modify')->with('flash_warning', '変更に失敗しました。お手数ですが、初めからやり直してください。');
    }
}
