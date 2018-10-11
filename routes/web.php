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

Route::get('/blog', 'HomeController@index')->name('home');

Route::get('/posts', 'PostsController@index')->name('post.index');

Route::get('/post/{slug}', 'PostsController@details')->name('post.details');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');

    Route::post('comment/{post}', 'CommentsController@store')->name('comments.store');
    
});

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function() {

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

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'author', 'middleware' => ['auth', 'author']], function(){

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostsController');

    Route::get('/comments', 'CommentsController@index')->name('comments.index');
    Route::delete('/comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
});
