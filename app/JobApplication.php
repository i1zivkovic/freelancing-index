<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    protected $fillable = ['job_id','user_id', 'comment', 'job_application_state_id'];


    public function job_application_state() {
        return $this->belongsTo('App\JobApplicationState');
    }

    public function job() {
        return $this->belongsTo('App\Job');
    }

}
