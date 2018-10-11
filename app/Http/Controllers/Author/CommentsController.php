<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Brian2694\Toastr\Facades\Toastr;

use App\Comment;

class CommentsController extends Controller
{
    public function index() {
    	$posts = Auth::user()->posts;
    	return view('author.comments', compact('posts'));
    }

    public function destroy($id) {
    	$comment = Comment::findOrFail($id);
    	if($comment->post->user->id == Auth::id()) {
    		$comment->delete();
    		Toastr::success('Comment Deleted Successfully :)', 'Success');
    	} else {
    		Toastr::error('You are not Authorized :(', 'Denied');
    	}

    	return redirect()->back();
    }
}
