<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(50);

        return view('users.index', ['users' => $users]);
    }

    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $books = $user->likes->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'books' => $books,
        ]);
    }

    // showアクションでいいねした本情報を取得
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        $books = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'books' => $books,
        ]);
    }

    // 削除処理アクション
    public function destroy(String $name)
    {
        $user = User::where('name', $name)->first();
        $user->delete();
        return redirect()->route('users.index');
    }
}
