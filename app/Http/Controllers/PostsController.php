<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Post;

class PostsController extends Controller
{
	public function index() {
		$posts = Post::latest()->paginate(6);
		return view('posts', compact('posts'));
	}

    public function details($slug) {
    	$post = Post::where('slug', $slug)->first();

    	$blogKey ='blog_' .$post->id;
    	
    	if(!Session::has($blogKey))
    	{
    		$post->increment('view_count');
    		Session::put($blogKey, 1);
    	}
    	
    	$randomposts = Post::all()->random(1);
    	return view('post', compact('post', 'randomposts'));
    }
}
