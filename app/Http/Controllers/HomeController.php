<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->take(6)->get();
        return view('welcome', compact('categories', 'posts'));
    }
}
