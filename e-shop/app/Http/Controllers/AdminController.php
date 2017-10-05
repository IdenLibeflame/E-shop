<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAllGenres()
    {
        $genres = Genre::all();

        return view('admin.showGenres', compact('genres'));
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

    public function updateGenre(Request $request)
    {
        $genre = Genre::find($request->id);

        $genre->name = $request->name;
        $genre->image = $request->image;

        return redirect()->back();

    }
}
