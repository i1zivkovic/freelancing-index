<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','description','slug','user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post_comments() {
        return $this->hasMany('App\PostComment');
    }
    public function post_likes() {
        return $this->hasMany('App\PostLike');
    }

    public function post_files() {
        return $this->hasOne('App\PostFile');
    }

}
