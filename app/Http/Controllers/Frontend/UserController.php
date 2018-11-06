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

    // my profile
    public function show($slug){
        $user = User::
        where('slug', $slug)
        ->with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail($user->id);


        return view('frontend.profile', compact('user','profile'));
    }



    // profile edit
    public function profile_edit($slug) {

        $user = User::
        where('slug', $slug)
        ->with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail($user->id);
        $selectedSkills = UserSkill::where('user_id', Auth::id()) ->pluck('skill_id');
        $skills = Skill::whereIn( 'id' ,$selectedSkills)->pluck('name','id');

        /* dd($user);
 */
        return view('frontend.profile_edit', compact('user', 'profile', 'selectedSkills', 'skills'));
    }
}
