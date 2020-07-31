<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

use AuthenticatesUsers;

/**
 * Where to redirect users after login.
 *
 * @var string
 */
protected $redirectTo = '/';

public function __construct()
{
    $this->middleware('guest:admin')->except('logout');
}

// 管理者ログイン画面
public function showLoginForm()
{
    return view('admin.login');
}

//管理者認証のguardを指定
protected function guard()
{
    return \Auth::guard('admin');
}

/**
 * Log the user out of the application.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function logout(Request $request)
{
    $this->guard('admin')->logout();

    $request->session()->invalidate();
    // ログアウト後のリダイレクト先
    return $this->loggedOut($request) ?: redirect(route('admin.login'));
}

}