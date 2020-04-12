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

    // 本登録画面表示アクション
    public function create()
    {
        return view('books.create');
    }

    // 本登録アクション
    public function store(BookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->description = $request->description;
        $book->book_image = $request->book_image;
        $book->state = $request->state;
        $book->save();
        return redirect()->route('books.index');
    }
}
