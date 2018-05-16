<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home.index', [
            'posts' => Post::latest()->paginate(9)
        ]);
    }
}
