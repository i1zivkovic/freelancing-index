<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'role_id', 'slug', 'is_active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function userSkills() {
        return $this->hasMany('App\UserSkill')->join('skills', 'user_skills.skill_id', 'skills.id')->select('user_skills.*', 'skills.name as name');
        }
    public function userBusinessCategories() {
        return $this->hasMany('App\UserBusinessCategory');
    }
    public function userLocation() {
        return $this->hasOne('App\Location');
    }
    public function userRole() {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
    public function userSocial() {
        return $this->hasOne('App\Social');
    }
    public function userProfile() {
        return $this->hasOne('App\Profile');
    }

}
