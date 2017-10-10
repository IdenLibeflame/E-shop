<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
