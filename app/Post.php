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

    public function postComments() {
        return $this->hasMany('App\PostComment');
    }
    public function postLikes() {
        return $this->hasMany('App\PostLike');
    }


}
