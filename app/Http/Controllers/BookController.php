<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            (object) [
                'id' => 1,
                'title' => '我輩は猫である',
                'author' => '夏目漱石',
                'publisher' => '新潮文庫',
                'description' => '先生の飼い猫目線の物語',
                'state' => true,
                'created_at' => now(),
            ],
            (object) [
                'id' => 2,
                'title' => '潮騒',
                'author' => '三島由紀夫',
                'publisher' => '新潮文庫',
                'description' => '離島に暮らす中学生の淡い青春恋愛物語',
                'state' => true,
                'created_at' => now(),
            ],
            (object) [
                'id' => 3,
                'title' => '人間失格',
                'author' => '太宰治',
                'publisher' => '新潮文庫',
                'description' => '自分の幸福の観念と世の中のそれが、まるでくい違っているような不安に悩む大庭葉蔵の半生を自意識過剰に描いた、太宰文学随一の傑作',
                'state' => true,
                'created_at' => now(),
            ],
        ];
        return view('books.index', ['books' => $books]);
    }
}
