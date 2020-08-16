<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // メイン画面アクション
    public function index(Request $request)
    {
        if ($request->get('title')) {
            $books = Book::searched($request->get('title'));
            $query = $request->get('title');
        } else {
            $books = Book::query();
            $query = '';
        }
        $books = $books->orderBy('created_at', 'DESC')->get();
        return view('books.index', [
            'books' => $books,
            'query' => $query
        ]);
    }

    // 本登録画面表示アクション
    public function create()
    {
        // tagテーブルの全データを取得
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('books.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    // 本登録アクション
    public function store(BookRequest $request, Book $book)
    {
        $this->storeUpdate($request, $book);

        return redirect()->route('books.index')->with('flash_success', '登録しました。');
    }

    // 本情報更新画面表示アクション
    public function edit(Book $book)
    {
        $tagNames = $book->tags->map(function ($tag) {
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
        $this->storeUpdate($request, $book);

        return redirect()->route('books.index')->with('flash_success', '更新しました。');
    }

    // 詳細画面表示アクション
    public function show(Book $book)
    {
        $bookings = \App\Booking::where(['book_id' => $book->id])->orderBy('booking_date_to')->get();
        return view('books.show', [
            'book' => $book,
            'bookings' => $bookings,
        ]);
    }

    // 削除処理アクション
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('flash_success', '削除しました。');
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

    private function storeUpdate(BookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->description = $request->description;
        $book->state = $request->state;
        if ($request->hasFile('book_image') && $request->file('book_image')->isValid()) {

            if($book->book_image) {
                // 旧画像ファイルを削除
                $old_file = 'public/images/' . $book->book_image;
                Storage::delete($old_file);
            }

            // storage/app/publicにファイルを保存
            $path = $request->file('book_image')->store('public/images');
            // 画像名DB保存
            $book->book_image = basename($path);
        }
        $book->save();

        // tagを一旦全て削除する
        $book->tags()->detach();
        $request->tags->each(function ($tagName) use ($book) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $book->tags()->attach($tag);
        });
    }
}
