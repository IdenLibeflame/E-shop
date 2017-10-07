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

        return view('admin.genres.showGenres', compact('genres'));
    }
}
