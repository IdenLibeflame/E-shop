<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class AdminGenresController extends Controller
{
    public function createGenre()
    {
        // Перенести 2 строчки ниже в код для создания нового товара
//        $genresList = Genre::all('name');
//        return view('admin.createGenre', compact('genresList'));


        return view('admin.genres.createGenre');
    }

    public function addGenre(Request $request)
    {
        $genre = new Genre;

        $genre->name = $request->name;
        $genre->image = $request->image;
        $genre->save();

        return redirect()->to('admin/showGenres');
    }

    public function deleteGenre($genre_id)
    {
        $genre = Genre::find($genre_id);

        $genre->delete();

        return redirect()->back();
    }

    public function editGenre($genre_id)
    {
        $genre = Genre::find($genre_id);

        return view('admin.genres.editGenre', compact('genre'));
    }

    public function updateGenre(Request $request)
    {
        $genre = Genre::find($request->id);
//dd($genre);
        $genre->name = $request->name;
        $genre->image = $request->image;
        $genre->update();

        return redirect()->to('admin/showGenres');

    }
}
