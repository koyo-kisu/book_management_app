<?php

namespace App\Http\Controllers\Auth;

use App\EmailVerification;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 仮登録時のバリデーション
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * registerを仮登録処理にする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // 本登録データを見てバリデーションかける
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        // 仮登録データ作成
        $user = EmailVerification::build($request->all());

        try {
            // 認証用メール送信
            Mail::to($request->email)->send(new \App\Mail\EmailVerification($user));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error("登録に失敗しました。 {$e->getMessage}", $e->getTrace());
            return redirect()->back()->withErrors(['error' => '登録に失敗しました。']);
        }
        return $this->registered();
    }

    /**
     * 登録後は仮登録完了画面へ
     * @return \Illuminate\View\View
     */
    protected function registered()
    {
        return view('auth.registered');
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
            'id' => ['required'],
            'token' => ['required', 'string'],
        ]);
    }

    /**
     * メールアドレス認証処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emailVerifyComplete(Request $request)
    {
        $validator = $this->verifyValidator($request->all());

        // バリデーション失敗時
        if($validator->fails()) {
            return $this->verifyFailed();
        }

        $emailVerification = EmailVerification::findByIdToken($request->all());

        // データが見つからない場合
        if(empty($emailVerification)) {
            return $this->verifyFailed();
        }

        DB::beginTransaction();
        try {
            // 仮登録情報を本登録ユーザーとして登録
            event(new Registered($user = $this->createUser($emailVerification)));
            // 仮登録情報を削除
            $emailVerification->delete();
            // ログイン
            $this->guard()->login($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error("認証に失敗しました。 {$e->getMessage}", $e->getTrace());
            return redirect()->route('register')->withErrors(['error' => '認証に失敗しました。']);
        }
        return redirect($this->redirectPath())->with('flash_success', '認証が完了しました。');
    }


    /**
     * 本登録ユーザー作成
     *
     * @param EmailVerification $emailVerification
     * @return User $user
     */
    protected function createUser(EmailVerification $emailVerification)
    {
        return User::create([
            'name' => $emailVerification->name,
            'email' => $emailVerification->email,
            'password' =>  $emailVerification->password,
        ]);
    }

    /**
     * 認証失敗時
     *
     * @return \Illuminate\Http\Response
     */
    protected function verifyFailed()
    {
        return redirect()->route('register')->with('flash_warning', '認証に失敗しました。お手数ですが、初めからやり直してください。');
    }
}
