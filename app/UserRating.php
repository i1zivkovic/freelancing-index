<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    //
    protected $fillable = ['user_id','job_id','comment','rating'];
}
