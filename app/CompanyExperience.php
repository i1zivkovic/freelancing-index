<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyExperience extends Model
{
    /* Relation between company and experience */
    protected $fillable = ['company_id','start_date','end_date','job_title','job_description','job_location_city','job_location_state','job_location_country'];
}
