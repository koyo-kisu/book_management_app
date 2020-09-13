<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
