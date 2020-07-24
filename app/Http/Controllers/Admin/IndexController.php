<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Tag;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all()->sortByDesc('created_at');
        return view('admin.index', [
            'books' => $books,
        ]);
    }

    public function apply()
    {
        return view('admin.apply');
    }

    public function user()
    {
        return view('admin.user');
    }
}
