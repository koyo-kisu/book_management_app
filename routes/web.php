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

// ユーザー側ルート定義
Auth::routes();
Route::get('/', 'BookController@index')->name('books.index');
// リソースフルルートでルート定義
Route::resource('/books', 'BookController')->except(['index', 'show'])->middleware('auth');
Route::resource('/books', 'BookController')->only(['show']);

// いいね機能
Route::prefix('books')->name('books.')->group(function () {
    Route::put('/{book}/like', 'BookController@like')->name('like')->middleware('auth');
    Route::delete('/{book}/like', 'BookController@unlike')->name('unlike')->middleware('auth');
});

// タグつけ機能
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// 予約申請ルート定義
Route::prefix('bookings')->name('bookings.')->group(function () {
    Route::post('/', 'BookingController@store')->name('store');
});

// ユーザーページ
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UserController@index')->name('index')->middleware('auth:admin');
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::delete('/{name}', 'UserController@destroy')->name('destroy');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
});

// 管理側ルート定義
// ログイン機能
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('login')->middleware('guest:admin');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('login')->middleware('guest:admin');
});

// ログアウト機能
Route::prefix('admin')->name('admin.')->group(function () {
  Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout')->middleware('auth:admin');
  // Route::post('create', 'Admin\Auth\LoginController@create')->name('create')->middleware('auth:admin');
});