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

use App\Http\Middleware\isAdmin;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('e-shop');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/genre', 'GenreController@genre');


Route::get('/genre/{name}', 'ProductController@products')->name('name');

Route::get('/genre/{name}/book/{book_id}', 'ProductController@product')->name('book');

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

Route::get('/search/', function () {
    return view('search.index');
});

//Route::post('/search/result/', function ($query) {
//    $results = App\Product::search($query)->get();
//
//    return view('search.result', compact('results'));
//});

//Route::get('/search', function () {
//    return view('search.index');
//});
//
Route::post('search/result', 'ProductController@search')->name('name');



Route::get('login/redirect/{provider}', 'SocialAuthController@redirect');

Route::get('login/callback/{provider}', 'SocialAuthController@callback');



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


Route::post('checkout', 'BasketController@postCheckout')->name('checkout');

// Это можно будет засунуть в контроллер вместо кода выше
//public function __construct()
//{
//    $this->middleware('auth');
//}


Route::get('admin/index', function () {
   return view('admin.index');
})->name('admin/index')->middleware(isAdmin::class);


Route::get('admin/showGenres', 'AdminController@showAllGenres')->middleware(isAdmin::class);

//Route::get('admin/createGenre', 'AdminController@createGenre')->middleware(isAdmin::class);

Route::get('admin/createGenre', function () {
   return view('admin.createGenre');
})->middleware(isAdmin::class);

Route::post('admin/addGenre', 'AdminController@addGenre')->name('admin/addGenre')->middleware(isAdmin::class);

Route::get('admin/deleteGenre/{genre_id}', 'AdminController@deleteGenre')->name('admin/deleteGenre')->middleware(isAdmin::class);

Route::post('admin/{name}/editGenre{genre_id}', function (Request $request) {
    return view('admin.updateGenre', compact('request'));
})->middleware(isAdmin::class);


Route::post('admin/{name}/updateGenre{genre_id}', 'AdminController@updateGenre')->middleware(isAdmin::class);

//Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
//    Route::get('users', function ()    {
//        return view('admin.index');
//    });
//
//});

