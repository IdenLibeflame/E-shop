<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class AdminGenresController extends Controller
{
    public function showAllGenres()
    {
        $genres = Genre::paginate(2);

        return view('admin.genres.showGenres', compact('genres'));
    }

    public function createGenre()
    {
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
        $genre->name = $request->name;
        $genre->image = $request->image;
        $genre->update();

        return redirect()->to('admin/showGenres');

    }
}
