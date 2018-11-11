<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\UserSkill;
use App\Skill;
use Auth;

class UserController extends Controller
{

    /**
     * Method used to show profile
     * @param $slug user slug
     */
    public function show($slug){
        $user = User::
        where('slug', $slug)
        ->with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail($user->id);


        return view('frontend.profile', compact('user','profile'));
    }



    /**
     * Method used to show edit view for specific user
     * @param $lug user slug
     */
    public function profile_edit($slug) {

        //get the user data
        $user = User::
        where('slug', $slug)
        ->with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();

        //check if the user is editing self
        if ($user->id != Auth::id()) {
            return abort(403);
        }

        // get the additional data
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail($user->id);
        $selectedSkills = UserSkill::where('user_id', Auth::id()) ->pluck('skill_id');
        $skills = Skill::whereIn( 'id' ,$selectedSkills)->pluck('name','id');

        // return view with data
        return view('frontend.profile_edit', compact('user', 'profile', 'selectedSkills', 'skills'));
    }
}
