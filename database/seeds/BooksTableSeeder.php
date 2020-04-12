<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => '吾輩は猫である',
                'author' => '夏目漱石',
                'publisher' => '新潮文庫',
                'description' => 'textext',
                'book_image' => 'aaaa',
                'state' => true,
                'created_at' => '2014_10_12',
                'updated_at' => '2014_10_12'
            ],
            [
                'title' => '人間失格',
                'author' => '太宰治',
                'publisher' => '新潮文庫',
                'description' => 'textext',
                'book_image' => 'aaaa',
                'state' => true,
                'created_at' => '2014_10_12',
                'updated_at' => '2014_10_12'
            ],
            [
                'title' => '城の崎にて',
                'author' => '志賀直哉',
                'publisher' => '新潮文庫',
                'description' => 'textext',
                'book_image' => 'aaaa',
                'state' => true,
                'created_at' => '2014_10_12',
                'updated_at' => '2014_10_12'
            ],
        ]);
    }
}
