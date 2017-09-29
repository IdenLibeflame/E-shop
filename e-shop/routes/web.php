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

Route::get('/reduce/{id}', 'BasketController@reduceByOne');

Route::get('/remove/{id}', 'BasketController@removeItem');

Route::post('/createcomment', [
    'uses' => 'CommentController@createComment',
    'as' => 'comment.create'
]);

Route::get('/deletecomment/{comment_id}', [
   'uses' => 'CommentController@deleteComment',
    'as' => 'comment.delete'
]);

//Route::post('/edit', function (\Illuminate\Http\Request $request) {
//   return response()->json(['message' => $request['commentId']]);
//})->name('edit');

Route::post('/edit', [
    'uses' => 'CommentController@editComment',
    'as' => 'edit'
]);

Route::post('/like', [
    'uses' => 'CommentController@likeComment',
    'as' => 'like'
]);

Route::get('profile', function () {
    // Только аутентифицированные пользователи могут зайти...
})->middleware('auth');

Route::get('/basket', 'BasketController@getBasket');

Route::get('/add-to-basket/{id}', [
    'uses' => 'BasketController@addToBasket',
    'as' => 'basket.addToBasket'
]);

Route::get('checkout', 'BasketController@getCheckout')->name('checkout');

//Route::get('checkout',[
//   'uses' => 'BasketController@getCheckout',
//    'as' => 'checkout'
//]);

Route::post('checkout', 'BasketController@postCheckout')->name('checkout');

// Это можно будет засунуть в контроллер вместо кода выше
//public function __construct()
//{
//    $this->middleware('auth');
//}