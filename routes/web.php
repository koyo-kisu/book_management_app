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

// 管理側ルート定義
// ルーティングの頭をprefixで定義
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function() {

  Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.layout.login');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.layout.login');

});

// 管理者権限ルート
Route::middleware(['middleware' => 'auth:admin'])->group(function(){
    // ログアウト
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    });
});

// ユーザーページ
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::delete('/{name}', 'UserController@destroy')->name('destroy');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
});
