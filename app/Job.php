<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = ['user_id','title','description','slug','offer','is_per_hour','is_remote','job_status_id','job_location_city','job_location_country'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function job_skills(){
        return $this->hasMany('App\JobSkill')->join('skills', 'job_skills.skill_id', 'skills.id')->select('job_skills.*', 'skills.name as name');
    }

    public function job_comments(){
        return $this->hasMany('App\JobComment');
    }

    public function job_likes(){
        return $this->hasMany('App\JobLike');
    }

    public function job_status(){
        return $this->belongsTo('App\JobStatus');
    }

    public function job_business_categories() {
        return $this->hasMany('App\JobBusinessCategory')->join('business_categories', 'job_business_categories.business_category_id', 'business_categories.id')->select('job_business_categories.*', 'business_categories.name as name');
    }

    public function job_files() {
        return $this->hasOne('App\JobFile');
    }

}
