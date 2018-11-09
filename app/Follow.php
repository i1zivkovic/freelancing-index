<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /** Follow model consisting of user and follower id's */
    protected $fillables = ['user_id','follower_id'];

}
