<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    protected $fillable = ['user_id','instagram','github','linkedin','facebook','twitter','google_plus'];
}
