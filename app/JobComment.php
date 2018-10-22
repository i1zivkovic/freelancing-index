<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobComment extends Model
{
    //
    protected $fillable = ['job_id','user_id','comment'];
}
