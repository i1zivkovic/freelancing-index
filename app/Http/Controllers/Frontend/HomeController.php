<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use App\Job;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $user = User::with([
            'userSkills',
            'userBusinessCategories' => function($query) {
                $query -> join('business_categories', 'user_business_categories.business_category_id', 'business_categories.id');
                $query -> select('user_business_categories.*', 'business_categories.name as name');
            },
            'userLocation',
            'userRole',
            'userSocial',
            'userProfile'
        ]) -> findOrFail(Auth::id());
        return view('frontend.home', compact('user')); */

        $recentPosts = Post::
        withCount('postLikes', 'postComments')
        ->with([
            'user' => function($query) {
                $query->select('id','username','slug');
            }
        ]) ->orderBy('created_at','DESC')->take(3)->get();


        $recentJobs = Job::with([
            'user' => function($query) {
                $query->select('id','username','slug');
            }
        ]) ->orderBy('created_at','DESC')
        ->select('id','slug','user_id', 'title', 'offer', 'is_per_hour', 'job_location_city','job_location_country','is_remote') //
        ->take(4)->get();


        $jobCount = Job::count();

        $userCount = User::count();


        return view('frontend.home', compact('recentPosts','recentJobs','jobCount','userCount'));


    }
}
