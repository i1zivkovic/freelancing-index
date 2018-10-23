<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\BusinessCategory;
use App\JobBusinessCategory;
use App\JobSkill;
use Carbon\Carbon;
use App\Skill;

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
            'job_skills',
            'job_status'
        ])
        ->withCount(['job_likes', 'job_comments'])
        -> orderBy('created_at','desc') -> paginate(5);

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

        $businessCategories = BusinessCategory::pluck('name','id');
        return view('frontend.job_create', compact('businessCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $job = Job::create($request->except(['business_category_id','skill_list'])+['slug' => str_slug($request->title, '-').time(), 'user_id' => Auth::id(), 'job_status_id' => 1]);


        $arrCategories = [];
        $arrSkills= [];
        $categories = $request->business_category_id;
        $skills = $request->skill_list;
        $now = Carbon::now();

        for ($i = 0; $i < count($categories); $i++) {
            array_push($arrCategories, ['business_category_id' => $categories[$i], 'job_id' => $job->id, 'created_at' => $now, 'updated_at' => $now]);
        }
        for ($i = 0; $i < count($skills); $i++) {
            array_push($arrSkills, ['skill_id' => $skills[$i], 'job_id' => $job->id, 'created_at' => $now, 'updated_at' => $now]);
        }

        JobBusinessCategory::insert($arrCategories);

        JobSkill::insert($arrSkills);


        if(!empty($request->file('file'))){
            $file = $this->uploadFile($request->file('file'), Auth::user()->username);
            $job->job_files()->create(['path' => $file]);
        }

        return redirect()->to('jobs/'.$job->slug);
    }



    public function uploadFile($file, $folder){

        if (!is_dir(public_path().'/uploads/'.$folder)) {
            mkdir(public_path().'/uploads/'.$folder, 0777, true);
        }

        $destinationPath = public_path().'/uploads/'.$folder.'/';

        $file_name = time().'-'.$file->getClientOriginalName();

        $file->move($destinationPath, $file_name);

        return $file_name;
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
        ->withCount('job_likes')
        ->with([
            'user',
            'job_skills',
            'job_business_categories',
            'job_status',
            'job_comments' => function($query) {
                $query -> join('users', 'job_comments.user_id', 'users.id');
                $query -> join('profiles', 'users.id', 'profiles.user_id');
                $query -> select('job_comments.*', 'users.username', 'users.slug', 'profiles.first_name', 'profiles.last_name')->orderBy('created_at','ASC');
            }
        ]) -> firstOrFail();

           /*  dd($job); */

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
        $job = Job::
        where('id',$id)
        ->with('job_files')
        ->firstOrFail();


        $selectedCategories = JobBusinessCategory::where('job_id', $id) ->pluck('business_category_id');
        $businessCategories = BusinessCategory::pluck('name','id');

        $selectedSkills = JobSkill::where('job_id', $id) ->pluck('skill_id');
        $skills = Skill::whereIn( 'id' ,$selectedSkills)->pluck('name','id');

       /*  dd($skills); */

        return view('frontend.job_edit', compact('job','businessCategories', 'selectedCategories', 'selectedSkills', 'skills'));
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

        $job = Job::with('job_files')
        ->findOrFail($id);

        $job->update($request->except(['business_category_id','skills_list'])+['slug'=> str_slug($request->title, '-').time()]);

        if(!empty($request->file('file'))){
            if(!empty($job->job_files)) {
                 $fileCheck = public_path().'/uploads/'.Auth::user()->username.'/'.$job->job_files->path;
            if( file_exists($fileCheck) ) {
                unlink($fileCheck);
            }
         }
            $file = $this->uploadFile($request->file('file'), Auth::user()->username);
            $job->job_files()->updateOrCreate([], ['path'=>$file]);
         }

         $arrCategories = [];
         $arrSkills= [];
         $categories = $request->business_category_id;
         $skills = $request->skill_list;
         $now = Carbon::now();

         for ($i = 0; $i < count($categories); $i++) {
             array_push($arrCategories, ['business_category_id' => $categories[$i], 'job_id' => $id, 'created_at' => $now, 'updated_at' => $now]);
         }
         for ($i = 0; $i < count($skills); $i++) {
             array_push($arrSkills, ['skill_id' => $skills[$i], 'job_id' => $id, 'created_at' => $now, 'updated_at' => $now]);
         }

         JobBusinessCategory::where('job_id', $id)->delete();
         JobBusinessCategory::insert($arrCategories);

         JobSkill::where('job_id', $id)->delete();
         JobSkill::insert($arrSkills);


        return redirect()->to('jobs/'.$job->slug);
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
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
            $keywords = explode(' ', $request->input('q'));
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('job_skills', function ($query) use ($keyword){
                        $query->join('skills', 'job_skills.skill_id', 'skills.id');
                        $query->select('skills.id', 'name', 'job_id');
                        $query->where('name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        ->when($request->input('location'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $locations = explode(' ', $request->input('location'));
                foreach ($locations as $location) {
                    $query->where('job_location_zip', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_state', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_country', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_street', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_city', 'like', '%'.$location.'%');
                }
            });
        })
        ->with([
        'job_skills',
        'job_status',
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['job_likes', 'job_comments'])
        ->paginate(5);

        return view('frontend.jobs', compact('jobs', 'request'));
    }

    public function postMyJobsFilter(Request $request){

        $jobs = Job::
        where('user_id', Auth::id())
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
            $keywords = explode(' ', $request->input('q'));
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('job_skills', function ($query) use ($keyword){
                        $query->join('skills', 'job_skills.skill_id', 'skills.id');
                        $query->select('skills.id', 'name', 'job_id');
                        $query->where('name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        ->when($request->input('location'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $locations = explode(' ', $request->input('location'));
                foreach ($locations as $location) {
                    $query->orWhere('job_location_country', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_city', 'like', '%'.$location.'%');
                }
            });
        })
        ->with([
        'job_skills',
        'job_status',
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['job_likes', 'job_comments'])
        ->paginate(5);

        return view('frontend.user_jobs', compact('jobs', 'request'));
    }



    /**
     * Get all posts for specified user id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyJobs($slug)
    {


        $jobCount = Job::
        where('user_id', Auth::id())
        ->count();

        $jobs = Job::
        where('user_id', Auth::id())
        ->withCount('job_comments','job_likes')
        ->with([
            'user',
        ]) -> paginate(5);

        return view('frontend.user_jobs', compact('jobs','jobCount'));


    }
}

