<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

use App\Post;
use App\Category;
use App\Tag;
use App\Subscriber;

use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
       ]);

       $image = $request->file('image');
       $slug = str_slug($request->title);

       if(isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600, 1066)->save($imagename);
            Storage::disk('public')->put('post/'.$imagename, $postImage);           
       } else {
            $imagename = 'default.png';
       }

       $post = new Post;
       $post->user_id = Auth::id();
       $post->title = $request->title;
       $post->slug = $slug;
       $post->image = $imagename;
       $post->body = $request->body;

       if(isset($request->status)) {
            $post->status = true;
       } else {
            $post->status = false;
       }

       $post->is_approved = true;
       $post->save();

       //Relationships
       $post->categories()->attach($request->categories);
       $post->tags()->attach($request->tags);

       $subscribers = Subscriber::all();
       foreach($subscribers as $subscriber) {
           Notification::route('mail', $subscriber->email)
            ->notify(new NewPostNotify($post));
       }

       Toastr::success('Post Saved Successfully :)', 'success');
       return redirect()->route('admin.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       $this->validate($request, [
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
       ]);

       $image = $request->file('image');
       $slug = str_slug($request->title);

       if(isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete old post image
            if(Storage::disk('public')->exists('posts/'.$post->image)) 
            {
              Storage::disk('public')->delete('post/'.$post->image);
            }

            $postImage = Image::make($image)->resize(1600, 1066)->save($imagename);
            Storage::disk('public')->put('post/'.$imagename, $postImage);           
       } else {
            $imagename = $post->image;
       }

       $post->user_id = Auth::id();
       $post->title = $request->title;
       $post->slug = $slug;
       $post->image = $imagename;
       $post->body = $request->body;

       if(isset($request->status)) {
            $post->status = true;
       } else {
            $post->status = false;
       }

       $post->is_approved = true;
       $post->save();

       //Relationships
       $post->categories()->sync($request->categories);
       $post->tags()->sync($request->tags);

       Toastr::success('Post Updated Successfully :)', 'success');
       return redirect()->route('admin.post.index');

    }
    
    public function pending() 
    {
      $posts = Post::where('is_approved', false)->get();
      return view('admin.posts.pending', compact('posts'));
    }

    public function approve($id)
    {
      $post = Post::find($id);
      if($post->is_approved == false) {
        $post->is_approved = true;
        $post->save();

        //Send notification to author
        $post->user->notify(new AuthorPostApproved($post));

        Toastr::success('Post Successfully Approved :)', 'success');
      } else {
        Toastr::info('Post has already been approved :)', 'Info');
      }

      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
        	Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();

        Toastr::success('Post Deleted Sucessfully :)', 'success');

        return redirect()->back();
    }
}
