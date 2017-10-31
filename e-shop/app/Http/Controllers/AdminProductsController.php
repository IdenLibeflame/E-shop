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
        $product = new Product();
        $product->name = $request->name;
        $product->writer = $request->writer;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->current_price = $request->current_price;
        $product->availability = $request->availability;
        $product->discount = $request->discount;
        $product->genre_name = $request->genre_name;
        $product->image = $request->image;

        $product->save();

        return redirect()->to('admin/showProducts');
    }

    public function editProduct($product_id)
    {
        $genresList = Genre::all('name');

        $product = Product::find($product_id);

        return view('admin.products.editProduct', compact('product', 'genresList'));
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->writer = $request->writer;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->current_price = $request->current_price;
        $product->availability = $request->availability;
        $product->discount = $request->discount;
        $product->genre_name = $request->genre_name;
        $product->image = $request->image;
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

        $results = Product::search($query)->get();

        return back()->with('results', $results);
    }
}
