<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // メイン画面アクション
    public function index()
    {
        $books = Book::all();
        return view('books.index', [ 'books' => $books ]);
    }
}
