<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
    	$this->belongsTo('App\User');
    }

    public function categories() {
    	$this->belongsToMany('App\Category')->withTimestamps();
    }

    public function tags() {
    	$this->belongsToMany('App\Category')->withTimestamps();
    }
}
