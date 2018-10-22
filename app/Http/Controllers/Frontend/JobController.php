<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $jobs = Job:: with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);


        /* dd($jobs); */

        return view('frontend.jobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frontend.job_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       /*  dd($request); */
        //
        $job = new Job;
        $job->title = $request->title;
        $job->user_id = Auth::id();
        $job->job_status_id = 1;
        $job->description = $request->description;
        $job->slug = str_slug($request->title, '-').time();
        $job->is_per_hour = $request->is_per_hour;
        $job->offer = $request->offer;
        $job->job_location_city = $request->job_location_city;
        $job->job_location_country = $request->job_location_country;

        $job->save();

        return redirect()->to('jobs/'.$job->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //

        $job = Job::
        where('slug',$slug)
        ->with([
            'user'
        ]) -> firstOrFail();

        return view('frontend.job_details', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $job = Job::where('id',$id)->firstOrFail();

        return view('frontend.job_edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function postJobsFilter(Request $request){

        $jobs = Job::
        where('job_status_id', 1)
        ->when($request->input('keywords'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('keywords').'%');
            $keywords = explode(' ', $request->input('keywords'));
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('job_skills', function ($query) use ($keyword){
                        $query->join('skills', 'job_skills.skill_id', 'skills.id');
                        $query->select('skills.id', 'name', 'job_id');
                        $query->where('name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        ->with([
        'job_skills', 
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->paginate(9);

        return view('frontend.jobs', compact('jobs', 'request'));
    }
}
