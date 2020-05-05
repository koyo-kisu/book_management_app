<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'BookController@index')->name('books.index');
// リソースフルルートでルート定義
Route::resource('/books', 'BookController')->except(['index', 'show'])->middleware('auth');
Route::resource('/books', 'BookController')->only(['show']);

// いいね機能
Route::prefix('books')->name('books.')->group( function() {
  Route::put('/{book}/like', 'BookController@like')->name('like')->middleware('auth');
  Route::delete('/{book}/like', 'BookController@unlike')->name('unlike')->middleware('auth');
});

// タグつけ機能
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// ユーザーページ
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
});