<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use App\Job;
use App\JobApplication;
use App\Company;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the application home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get recent posts
        $recentPosts = Post::
        withCount('post_likes', 'post_comments')
        ->with([
            'user' => function($query) {
                $query->select('id','username','slug');
            }
        ]) ->orderBy('created_at','DESC')->take(3)->get();

        //get recent jobs
        $recentJobs = Job::with([
            'job_skills',
            'job_business_categories',
            'job_status',
            'user' => function($query) {
                $query->select('id','username','slug');
            }
        ]) ->withCount(['job_likes', 'job_comments', 'job_applications'])
        ->orderBy('created_at','DESC')
        /* ->select('id','slug','user_id', 'title', 'description','offer', 'is_per_hour', 'job_location_city','job_location_country','is_remote')  *///
        ->take(4)->get();

       /* Get counts */
        $jobCount = Job::count();
        $userCount = User::count();
        $postCount = Post::count();
        $jobApplicationCount = JobApplication::count();
        $companyCount = Company::count();

            // return home page with counts and recent data
        return view('frontend.home', compact('recentPosts','recentJobs','jobCount','userCount','jobApplicationCount','postCount'));
    }


    // return FAQ page
    public function faq() {
        return view('frontend.faq');
    }


    // return ABOUT page
    public function about() {
        return view('frontend.about');
    }


}
