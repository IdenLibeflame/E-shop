<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Product;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    public function showAllProducts()
    {
        $products = Product::paginate(1);

        return view('admin.products.showProducts', compact('products'));
    }

    public function createProduct()
    {
        $genresList = Genre::all('name');

        return view('admin.products.createProduct', compact('genresList'));
    }

    public function addProduct(Request $request)
    {
            $pathToAttach = '/public/src/productImage/';
            $file = $request->file('image');
            $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';

            $file->move(public_path().$pathToAttach, $filename);

            $product = new Product();
            $product->name = $request->name;
            $product->writer = $request->writer;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->current_price = $request->current_price;
            $product->availability = $request->availability;
            $product->discount = $request->discount;
            $product->genre_name = $request->genre_name;
            $product->image = '/public/src/productImage/'.$filename;

            $product->save();

            return redirect()->to('admin/showProducts');

    }

    public function editProduct($product_id)
    {
        $genresList = Genre::all('name');

        $product = Product::find($product_id);
//        dd($product->current_price);

        return view('admin.products.editProduct', compact('product', 'genresList'));
    }

    public function updateProduct(Request $request)
    {
//        dd($request);
        $pathToAttach = '/public/src/productImage/';
        $file = $request->file('image');
        $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';

        $file->move(public_path().$pathToAttach, $filename);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->writer = $request->writer;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->current_price = $request->current_price;
        $product->availability = $request->availability;
        $product->discount = $request->discount;
        $product->genre_name = $request->genre_name;
        $product->image = '/public/src/productImage/'.$filename;
        $product->update();

        return redirect()->to('admin/showProducts');

    }

    public function deleteProduct($product_id)
    {
        $product = Product::find($product_id);

        $product->delete();

        return redirect()->back();
    }

    public function search()
    {

        $query = request()->input('query');

        $results = Product::search($query)->paginate(1);

//        return back()->with('results', $results);
        return view('admin.products.showProducts', compact('results'));
    }
}
