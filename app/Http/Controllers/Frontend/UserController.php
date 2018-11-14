<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\UserSkill;
use App\Skill;
use App\Post;
use App\Job;
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
        ->withCount('followers', 'following')
        ->with(['userProfile.profileEducation', 'userProfile.profileExperience', 'userSocial', 'userLocation', 'userSkills', 'rating.recruiter.userProfile', 'followers'])
        ->firstOrFail();

        $user_posts = Post::where('user_id', $user->id)
         ->withCount('post_likes','post_comments')
         ->orderBy('updated_at','DESC')
         ->paginate(3);

         $user_jobs = Job::
         where('user_id',$user->id)
         ->withCount('job_comments','job_likes', 'job_applications')
         ->with([
             'user',
         ]) -> orderBy('updated_at','desc')-> paginate(3);

        return view('frontend.profile', compact('user', 'user_posts', 'user_jobs'));
    }



    /**
     * Method used to show edit view for specific user
     * @param $lug user slug
     */
    public function profile_edit($slug) {

        //get the user data
        $user = User::
        where('slug', $slug)
        ->with(['userProfile.profileEducation', 'userProfile.profileExperience', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();

        //check if the user is editing self
        if ($user->id != Auth::id()) {
            return abort(403);
        }

        //get additional data for select 2
        $selectedSkills = UserSkill::where('user_id', Auth::id()) ->pluck('skill_id');
        $skills = Skill::whereIn( 'id' ,$selectedSkills)->pluck('name','id');

        // return view with data
        return view('frontend.profile_edit', compact('user', 'selectedSkills', 'skills'));
    }
}
