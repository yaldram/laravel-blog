<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('index');
})->name('index');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/details', function() {
    return view('resume');
})->name('resume');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

Route::get('/work', function() {
    return view('work');
})->name('work');

Route::get('/blog', 'HomeController@index')->name('home');

Route::get('/posts', 'PostsController@index')->name('post.index');

Route::get('/post/{slug}', 'PostsController@details')->name('post.details');

Route::get('/category/{slug}', 'PostsController@postsByCategory')->name('category.posts');

Route::get('/tag/{slug}', 'PostsController@postsByTag')->name('tag.posts');

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/profile/{username}', 'AuthorController@profile')->name('author.profile');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');

    Route::post('comment/{post}', 'CommentsController@store')->name('comments.store');
    
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function() {

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
     Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagsController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostsController');

    Route::get('/pending/post', 'PostsController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostsController@approve')->name('post.approve');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('/comments', 'CommentsController@index')->name('comments.index');
    Route::delete('/comments/{id}', 'CommentsController@destroy')->name('comments.destroy');

    Route::get('/authors', 'AuthorController@index')->name('authors.index');
    Route::delete('/authors/{id}', 'AuthorController@destroy')->name('authors.destroy');

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function(){

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostsController');

    Route::get('/comments', 'CommentsController@index')->name('comments.index');
    Route::delete('/comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
});

View::composer('layouts.frontend.partials.footer', function($view) {
    $categories = App\Category::all();
    $view->with('categories', $categories);
});
