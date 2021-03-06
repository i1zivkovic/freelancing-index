<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'role_id', 'slug', 'is_active', 'notify_applications', 'notify_application_status'];

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
    public function posts() {
        return $this->hasMany('App\Post');
    }
    public function followers() {
        return $this->hasMany('App\Follow');
    }
    public function following() {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'user_id');
    }
    public function rating() {
        return $this->hasMany('App\UserRating', 'rated_user_id');
    }

}
