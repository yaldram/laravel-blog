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

Auth::routes();

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagsController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostsController');

    Route::get('/pending/post', 'PostsController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostsController@approve')->name('post.approve');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'author', 'middleware' => ['auth', 'author']], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostsController');
});
