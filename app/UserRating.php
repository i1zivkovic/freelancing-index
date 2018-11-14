<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    //
    protected $fillable = ['user_id','rated_user_id','job_id','comment','rating'];

    public function job() {
        return $this->belongsTo('App\Job');
    }

    public function recruiter() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
