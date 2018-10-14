<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = ['user_id','gender','date_of_birth', 'about_me', 'website_url', 'first_name', 'last_name', 'contact_number', 'image_url'];
}
