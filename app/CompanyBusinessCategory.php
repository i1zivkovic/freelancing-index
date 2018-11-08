<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBusinessCategory extends Model
{
    /* Relation between company and business category */
    protected $fillable = ['company_id','business_category_id'];
}
