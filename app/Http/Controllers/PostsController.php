<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
	public function index() {
		$posts = Post::latest()->approved()->published()->paginate(6);
		return view('posts', compact('posts'));
	}

    public function details($slug) {
    	$post = Post::where('slug', $slug)->approved()->published()->first();

    	$blogKey ='blog_' .$post->id;
    	
    	if(!Session::has($blogKey))
    	{
    		$post->increment('view_count');
    		Session::put($blogKey, 1);
    	}
    	
    	$randomposts = Post::approved()->published()->take(3)->inRandomOrder(1);

    	return view('post', compact('post', 'randomposts'));
    }

    public function postsByCategory($slug) {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('category', compact('category', 'posts'));
    }

    public function postsByTag($slug) {
        $tag = Tag::where('slug', $slug)->first();
         $posts = $tag->posts()->approved()->published()->get();
        return view('tag', compact('tag', 'posts'));
    }
}
