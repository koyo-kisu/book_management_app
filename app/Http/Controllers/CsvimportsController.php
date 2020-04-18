<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;

use SplFileObject;

class CsvimportsController extends Controller
{
   public function index()
    {
        return view('books.csv');
    }

   /**
    * CSVインポート
    *
    * @param  Request
    * @return \Illuminate\Http\Response
    */
    public function import(Request $request)
    {
        //全件削除
        // Book::truncate();
    
        // ロケールを設定(日本語に設定)
        setlocale(LC_ALL, 'ja_JP.UTF-8');
    
        // アップロードしたファイルを取得
        // 'csv_file' はビューの inputタグのname属性
        $uploaded_file = $request->file('csv_file');
    
        // アップロードしたファイルの絶対パスを取得
        $file_path = $request->file('csv_file')->path($uploaded_file);
    
        //SplFileObjectを生成
        $file = new SplFileObject($file_path);
    
        //SplFileObject::READ_CSV が最速らしい
        $file->setFlags(SplFileObject::READ_CSV);
    
    
        $row_count = 1;
        
        //取得したオブジェクトを読み込み
        foreach ($file as $row)
        {
            // 最終行の処理(最終行が空っぽの場合の対策
            if ($row === [null]) continue; 
            
            // 1行目のヘッダーは取り込まない
            if ($row_count > 1)
            {
                // CSVの文字コードがSJISなのでUTF-8に変更
                $title = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
                $author = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
                $books_image = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
                $publisher = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');
                $description = mb_convert_encoding($row[4], 'UTF-8', 'SJIS');
                $state = mb_convert_encoding($row[5], 'UTF-8', 'SJIS');

                //1件ずつインポート
                Book::insert(array(
                    'title' => $title, 
                    'author' => $author, 
                    'books_image' => $books_image, 
                    'publisher' => $publisher,
                    'description' => $description,
                    'state' => $state,
                ));
            }
            $row_count++;
        }

        var_dump($row);
        
        return view('books.index');
    }
}
