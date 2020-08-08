<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $books_like = $user->likes->sortByDesc('created_at');
        $books_booking = $user->bookingsAfterToday();
        $books_history = $user->bookingsBeforeToday();

        return view('users.show', [
            'user' => $user,
            'books_like' => $books_like,
            'books_booking' => $books_booking,
            'books_history' => $books_history,
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
        return redirect()->route('users.index')->with('flash_success', '削除しました。');
    }
}
