<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminGenresController extends Controller
{
    public function showAllGenres()
    {
        $genres = Genre::paginate(3);

        return view('admin.genres.showGenres', compact('genres'));
    }

    public function createGenre()
    {
        return view('admin.genres.createGenre');
    }

    public function addGenre(Request $request)
    {
        $pathToAttach = '/public/src/genreImage/';
        $file = $request->file('image');
//        $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';
        $filename = $file->getClientOriginalName();

        $file->move(public_path().$pathToAttach, $filename);

        $img = Image::make(public_path().$pathToAttach.$filename);
        $img->resize(240, 320);
        $img->save();

        $genre = new Genre;

        $genre->name = $request->name;
        $genre->image = '/public/src/genreImage/'.$filename;
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

        if ($request->file('image')) {
            $pathToAttach = '/public/src/genreImage/';
            $file = $request->file('image');
//        $filename = str_random(20). '.' .$file->getClientOriginalExtension() ?: 'png';
            $filename = $file->getClientOriginalName();



            if (strcmp($genre->image, $pathToAttach.$filename) !==0) {
                $file->move(public_path().$pathToAttach, $filename);

                $img = Image::make(public_path().$pathToAttach.$filename);
                $img->resize(240, 320);
                $img->save();

                $genre->name = $request->name;
                $genre->image = '/public/src/genreImage/'.$filename;
                $genre->update();
            } else {
                $genre->name = $request->name;
                $genre->update();
            }
        } else {
            $genre->name = $request->name;
            $genre->update();
        }





        return redirect()->to('admin/showGenres');

    }
}
