<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, $post_id) {
    	$this->validate($request, [
    		'comment' => 'required'
    	]);

    	$comment = new Comment;
    	$comment->user_id = Auth::id();
    	$comment->post_id = $post_id;
    	$comment->comment = $request->comment;
    	$comment->save();
    	Toastr::success('Comment Sucessfully Added :)', 'Success');
    	return redirect()->back();
    }
}
