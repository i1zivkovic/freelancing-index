<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileEducation extends Model
{
    //
    protected  $fillable = ['profile_id','institution_name','major','start_date','end_date','description','degree'];
}
