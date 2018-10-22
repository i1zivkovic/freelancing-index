<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = ['user_id','title','description','slug','offer','is_per_hour','is_remote','job_status_id','job_location_zip','job_location_city','job_location_state','job_location_street','job_location_country'];


    public function user(){
        return $this->belongsTo('App\User');
    }

}
