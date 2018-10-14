<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileExperience extends Model
{
    //
    protected $fillable = ['start_date','end_date','job_title','job_description','company_name','job_location_city','job_location_state','job_location_country','profile_id','is_remote'];
}
