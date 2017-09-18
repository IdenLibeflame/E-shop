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

Route::get('/', function () {
    return view('e-shop');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/genre', 'GenreController@genre');


Route::get('/genre/{name}/{id}', 'ProductController@product')->name('name');

Route::get('/genre/{name}/book/{book_id}', 'ProductController@book')->name('a', 'book_id');


Route::get('/basket', 'BasketController@index');

Route::post('/createcomment', [
    'uses' => 'CommentController@createComment',
    'as' => 'comment.create'
]);


Route::get('profile', function () {
    // Только аутентифицированные пользователи могут зайти...
})->middleware('auth');

// Это можно будет засунуть в контроллер вместо кода выше
//public function __construct()
//{
//    $this->middleware('auth');
//}