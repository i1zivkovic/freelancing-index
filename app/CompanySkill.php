<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySkill extends Model
{
    /** Relation between company and skills */
    protected $fillable = ['skill_id', 'company_id'];
}
