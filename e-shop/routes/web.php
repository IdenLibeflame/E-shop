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
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('e-shop');
})->name('/');

Auth::routes();

Route::get('/feedback', 'FeedbackController@index')->name('/feedback');

Route::post('/sendFeedback', 'FeedbackController@sendFeedback')->name('sendFeedback');


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

Route::get('/profile', 'ProfileController@index')->name('/profile')->middleware('auth');

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

// АДМИНКА

Route::get('admin/index', 'AdminController@index')->name('admin/index')->middleware(isAdmin::class);

// ЖАНРЫ

Route::get('admin/showGenres', 'AdminGenresController@showAllGenres')->middleware(isAdmin::class);

Route::get('admin/createGenre', 'AdminGenresController@createGenre')->middleware(isAdmin::class);

Route::post('admin/addGenre', 'AdminGenresController@addGenre')->name('admin/addGenre')->middleware(isAdmin::class);

Route::get('admin/deleteGenre/{genre_id}', 'AdminGenresController@deleteGenre')->name('admin/deleteGenre')->middleware(isAdmin::class);

Route::get('admin/editGenre/{genre_id}', 'AdminGenresController@editGenre')->name('admin/editGenre')->middleware(isAdmin::class);

Route::post('admin/updateGenre', 'AdminGenresController@updateGenre')->name('admin/updateGenre')->middleware(isAdmin::class);

// ПРОДУКТЫ

Route::get('admin/showProducts', 'AdminProductsController@showAllProducts')->middleware(isAdmin::class);

Route::get('admin/createProduct', 'AdminProductsController@createProduct')->middleware(isAdmin::class);

Route::post('admin/addProduct', 'AdminProductsController@addProduct')->name('admin/addProduct')->middleware(isAdmin::class);

Route::get('admin/deleteProduct/{product_id}', 'AdminProductsController@deleteProduct')->name('admin/deleteProduct')->middleware(isAdmin::class);

Route::get('admin/editProduct/{product_id}', 'AdminProductsController@editProduct')->name('admin/editProduct')->middleware(isAdmin::class);

Route::post('admin/updateProduct', 'AdminProductsController@updateProduct')->name('admin/updateProduct')->middleware(isAdmin::class);

Route::post('admin/search/result', 'AdminProductsController@search')->name('query')->middleware(isAdmin::class);

