<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;

use App\Comment;

class CommentsController extends Controller
{
    public function index() {
    	$comments = Comment::latest()->get();
    	return view('admin.comments', compact('comments'));
    }

    public function destroy($id) {
    	Comment::findOrFail($id)->delete();
    	Toastr::success('Comment Deleted Successfully :)', 'Success');
    	return redirect()->back();
    }
}
