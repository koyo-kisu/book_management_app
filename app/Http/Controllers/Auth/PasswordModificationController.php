<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordModificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordModificationController extends Controller
{
    /**
     * パスワード変更画面表示
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        return view('auth.password.modify');
    }
    /**
     * パスワード変更処理
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(PasswordModificationRequest $request)
    {
        $user = \Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->route('books.index')->with('flash_success', 'パスワードを変更しました。');
    }
}
