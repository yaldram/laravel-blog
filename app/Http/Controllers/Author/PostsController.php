<?php

namespace App\Http\Controllers\Author;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

use App\Category;
use App\Tag;
use App\User;

use App\Notifications\NewAuthorPost;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.posts.index', compact('posts'));
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
        return view('author.posts.create', compact('categories', 'tags'));
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

       $post->is_approved = false;
       $post->save();

       //Relationships
       $post->categories()->attach($request->categories);
       $post->tags()->attach($request->tags);

       //Sending Notifications
       $admin_users = User::where('role_id', '1')->get();
       Notification::send($admin_users, new NewAuthorPost($post));

       Toastr::success('Post Saved Successfully :)', 'success');
       return redirect()->route('author.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        if($post->user_id != Auth::id()) {
          Toastr::error('You are not Authorized to Access this Post', 'Danger');
          return redirect()->back();
        }
        return view('author.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      if($post->user_id != Auth::id()) {
          Toastr::error('You are not Authorized to Access this Post', 'Danger');
          return redirect()->back();
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('author.posts.edit', compact('post','categories', 'tags'));
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

       $post->is_approved = false;
       $post->save();

       //Relationships
       $post->categories()->sync($request->categories);
       $post->tags()->sync($request->tags);

       Toastr::success('Post Updated Successfully :)', 'success');
       return redirect()->route('author.post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        if($post->user_id != Auth::id()) {
          Toastr::error('You are not Authorized to Access this Post', 'Danger');
          return redirect()->back();
        }
        
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
