<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminProductsController extends Controller
{
    public function showAllProducts()
    {
        $products = Product::paginate(3);

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
//            $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';
//            $filename = $file->getClientOriginalName(). '.' .$file->getClientOriginalExtension() ?: 'png';
            $filename = $file->getClientOriginalName();

            $file->move(public_path().$pathToAttach, $filename);

            $img = Image::make(public_path().$pathToAttach.$filename);
            $img->resize(240, 320);
            $img->save();

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

//        $product->image = explode('/', $product->image);
//        dd($product);

        return view('admin.products.editProduct', compact('product', 'genresList'));
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);

        if ($request->file('image')) {
            $pathToAttach = '/public/src/productImage/';
            $file = $request->file('image');
//        $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';
//        $filename = $file->getClientOriginalName(). '.' .$file->getClientOriginalExtension() ?: 'png';
            $filename = $file->getClientOriginalName();


            if (strcmp($product->image, $pathToAttach.$filename) !==0) {
                $file->move(public_path().$pathToAttach, $filename);

                $img = Image::make(public_path().$pathToAttach.$filename);
                $img->resize(240, 320);
                $img->save();

//        $product = Product::find($request->id);
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

            } else {
                $product->name = $request->name;
                $product->writer = $request->writer;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->current_price = $request->current_price;
                $product->availability = $request->availability;
                $product->discount = $request->discount;
                $product->genre_name = $request->genre_name;
                $product->update();
            }
        } else {
            $product->name = $request->name;
            $product->writer = $request->writer;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->current_price = $request->current_price;
            $product->availability = $request->availability;
            $product->discount = $request->discount;
            $product->genre_name = $request->genre_name;
            $product->update();
        }


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
        $results = Product::search($query)->paginate(3);

        return view('admin.products.showProducts', compact('results'));
    }
}
