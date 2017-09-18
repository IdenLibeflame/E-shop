<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function genre()
    {
        $genres = Genre::all();
        return view('genres', compact('genres'));
    }
}
