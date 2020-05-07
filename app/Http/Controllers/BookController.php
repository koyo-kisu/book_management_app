<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // メイン画面アクション
    public function index()
    {
        $books = Book::all()->sortByDesc('created_at');
        return view('books.index', [ 'books' => $books ]);
    }

    // 本登録画面表示アクション
    public function create()
    {
        // tagテーブルの全データを取得
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });

        return view('books.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    // 本登録アクション
    public function store(BookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->description = $request->description;
        $book->state = $request->state;
        if ($request->hasFile('book_image')->isValid()) {
            // 画像名のみDB保存
            $path = $request->file('book_image');
            $book->book_image = basename($path);
            // storage/app/publicにファイルを保存
            $request->file('book_image')->store('public/images');
            $book->save();
        } else {
            return;
        }

        $request->tags->each(function ($tagName) use ($book) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $book->tags()->attach($tag);
        });

        return redirect()
                ->route('books.index')
                ->with('file_name', basename($path));
    }

    // 本情報更新画面表示アクション
    public function edit(Book $book)
    {
        $tagNames = $book->tags->map(function($tag) {
            return ['text' => $tag->name];
        });

        // tagテーブルの全データを取得
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('books.edit', [
            'book' => $book,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);    
    }

    // 本情報更新処理アクション
    public function update(BookRequest $request, Book $book)
    {
        $book->fill($request->all())->save();

        // tagを一旦全て削除する
        $book->tags()->detach();
        $request->tags->each(function($tagName) use ($book) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            // 改めてtagを追加する
            $book->tags()->attach($tag);
        });

        return redirect()->route('books.index');
    }

    // 詳細画面表示アクション
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
        ]);
    }

    // 削除処理アクション
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    // いいねアクション
    public function like(Request $request, Book $book)
    {
        $book->likes()->detach($request->user()->id);
        $book->likes()->attach($request->user()->id);

        return [
            'id' => $book->id,
            'countLikes' => $book->count_likes,
        ];
    }

    // いいね解除アクション
    public function unlike(Request $request, Book $book)
    {
        $book->likes()->detach($request->user()->id);

        return [
            'id' => $book->id,
            'countLikes' => $book->count_likes,
        ];
    }
}