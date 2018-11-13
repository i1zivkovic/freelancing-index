<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\BusinessCategory;
use App\JobBusinessCategory;
use App\JobSkill;
use App\JobComment;
use App\JobLike;
use App\JobFile;
use App\JobApplication;
use Carbon\Carbon;
use App\Skill;
use App\User;
use Mail;
use File;
use Validator;
class JobController extends Controller
{
    /**
     * Display jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get the jobs with other info
        $jobs = Job:: with([
            'user',
            'job_skills',
            'job_status'
        ])
        ->withCount(['job_likes', 'job_comments', 'job_applications'])
        -> orderBy('created_at','desc') -> paginate(5);

        // return job view with jobs data
        return view('frontend.jobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get the business categories since there are only two
        $businessCategories = BusinessCategory::pluck('name','id');

        // return view with data
        return view('frontend.job_create', compact('businessCategories'));
    }

    /**
     * Store a newly created job in database.
     *
     * @param  \Illuminate\Http\Request  $request object containing info about new job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation rules
        $rules = [
            'title' => 'required|max:200|min:10',
            'job_location_country' => 'max:200|min:2',
            'job_location_city' => 'max:100|min:2',
            'description' => 'max:1000|min:50',
            'offer' => 'required|numeric'
        ];

        // make validator
        $validator = Validator::make($request->all(), $rules);

        // check if validation success
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // create job
        $job = Job::create($request->except(['business_category_id','skill_list'])+['slug' => str_slug($request->title, '-').time(), 'user_id' => Auth::id(), 'job_status_id' => 1]);


        // create relations
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


        // upload file if exists
        if(!empty($request->file('file'))){
            $file = $this->uploadFile($request->file('file'), Auth::user()->username, $job->id);
            $job->job_files()->create(['path' => $file]);
        }

        // redirect back to job
        return redirect()->to('jobs/'.$job->slug);
    }


    /**
     * Method used to upload files
     * @param $file file
     * @param $folder name of the folder
     */
    public function uploadFile($file, $username, $job_id){

        // if folder does not exists, create one with all persmissions
        if (!is_dir(public_path().'/uploads/'.$username.'/jobs/'.$job_id)) {
            mkdir(public_path().'/uploads/'.$username.'/jobs/'.$job_id, 0777, true);
        }

        // get the destination path
        $destinationPath = public_path().'/uploads/'.$username.'/jobs/'.$job_id.'/';

        // get the file name and create new one with timestamp
        $file_name = time().'-'.$file->getClientOriginalName();

        // move files / create file in $folder
        $file->move($destinationPath, $file_name);

        // return file
        return $file_name;
    }



    /**
     * Display the specified job details.
     *
     * @param  string  $slug Job slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // get the specific job with other data
        $job = Job::
        where('slug',$slug)
        ->withCount('job_likes')
        ->with([
            'user',
            'job_skills',
            'job_business_categories',
            'job_status',
            'job_applications' => function($query) {
                $query -> join('users', 'job_applications.user_id', 'users.id');
                $query -> join('profiles', 'users.id', 'profiles.user_id');
                $query -> join('job_application_states', 'job_applications.job_application_state_id', 'job_application_states.id');
                $query -> select('job_applications.*', 'users.username', 'users.slug','profiles.first_name', 'profiles.last_name', 'job_application_states.id as job_application_state_id','job_application_states.state as job_application_state')->orderBy('job_applications.created_at','DESC');
            },
            'job_comments' => function($query) {
                $query -> join('users', 'job_comments.user_id', 'users.id');
                $query -> join('profiles', 'users.id', 'profiles.user_id');
                $query -> select('job_comments.*', 'users.username', 'users.slug', 'profiles.first_name', 'profiles.last_name')->orderBy('job_comments.created_at','ASC');
            }
        ]) -> firstOrFail();

        // return job details with with given job data
        return view('frontend.job_details', compact('job'));
    }

    /**
     * Show the form for editing the specified job.
     *
     * @param  int  $id Id of the job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if there exists job
        if( Job::where([['id', $id]])->exists() ) {
            //get it
              $job = Job::
            where('id',$id)
            ->with('job_files')
            ->firstOrFail();

            // if the logged in user is not the owner, return 403
            if($job->user_id != Auth::id()) {
                return abort(403);
            }

            if($job->job_status_id == 2) {
                return back()->with("edit_error", "You can't edit this job for it is in 'Done' state.");
            }

            // get the stored data used for select 2 autocomplete
             $selectedCategories = JobBusinessCategory::where('job_id', $id) ->pluck('business_category_id');
             $businessCategories = BusinessCategory::pluck('name','id');

            $selectedSkills = JobSkill::where('job_id', $id) ->pluck('skill_id');
            $skills = Skill::whereIn( 'id' ,$selectedSkills)->pluck('name','id');


            // return edit view with data
            return view('frontend.job_edit', compact('job','businessCategories', 'selectedCategories', 'selectedSkills', 'skills'));
        }
        // if there does not exist that job or user is wrong, return error page
        else {
            return abort(404);
        }

    }

    /**
     * Update the specified job in database.
     *
     * @param  \Illuminate\Http\Request  $request object containing info about the job
     * @param  int  $id Job ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            // if there exists job that currently logged in user is owner of
         if( Job::where([['id', $id]])->exists() ) {

            // find the specific job
            $job = Job::with('job_files')
                ->findOrFail($id);

                // if the logged in user is not the owner
                if($job->user_id != Auth::id()) {
                    return abort(403);
                }

                // set validation rules
            $rules = [
                'title' => 'required|max:200|min:10',
                'job_location_country' => 'max:200|min:2',
                'job_location_city' => 'max:100|min:2',
                'description' => 'max:1000|min:50',
                'offer' => 'required|numeric',
            ];

            // create validator with given rules and check request
            $validator = Validator::make($request->all(), $rules);

            // check if validation succeeds
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            // update all field except categories and skills
            $job->update($request->except(['business_category_id','skills_list'])+['slug'=> str_slug($request->title, '-').time()]);

            // check for uploaded file
            if(!empty($request->file('file'))){
                if(!empty($job->job_files)) {
                    $fileCheck = public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job->id.'/'.$job->job_files->path;
                if( file_exists($fileCheck) ) {
                    //delete folder
                    File::deleteDirectory(public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job->id);
                }
            }
                $file = $this->uploadFile($request->file('file'), Auth::user()->username, $job->id);
                $job->job_files()->updateOrCreate([], ['path'=>$file]);
            }

            //create relations
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

            // store them
            JobBusinessCategory::where('job_id', $id)->delete();
            JobBusinessCategory::insert($arrCategories);

            //store job skills
            JobSkill::where('job_id', $id)->delete();
            JobSkill::insert($arrSkills);

            // if job is now in state 'Done'
            if($job->job_status_id == 2 || $job->job_status_id == 4) {

                /* Get the id of the waiting users */
                $waiting_applications_users = JobApplication::where([['job_id', $id], ['job_application_state_id', 1]])->select('user_id')->get();

                /* If there are waiting applications */
                if (!$waiting_applications_users->isEmpty()) {

                    /* Set all the waiting applications to rejected */
                    $waiting_job_applications = JobApplication::where([['job_id', $id], ['job_application_state_id', 1]]);
                    $waiting_job_applications->update(['job_application_state_id' => 3]);
                   /* Get users data from users that are waiting */
                    $waiting_users = User::whereIn('id',$waiting_applications_users)->select('id','email')->get();


                    /* send each user an e-mail */
                    foreach($waiting_users as $user) {
                         Mail::send('e-mails.job_application_response', ['job_slug' => $job->slug, 'job_application_state' => 'rejected'], function($msg) use ($user){
                        $msg->from(Auth::user()->email, 'TheHunt');
                        $msg->subject('Job Application Status Change');
                        $msg->to($user['email']);
                    });
                    }


                }

                //if job stauts is 'done'
                if($job->job_status_id == 2) {

                    //get the freelancers that are accepted
                    $freelancers = JobApplication::where([['job_id',$id], ['job_application_state_id',2]])->get();

                     // if there are freelancers that are accpeted
                    if(!$freelancers->isEmpty()) {

                        // redirect to the view used to rate those users
                        return redirect()->route('frontend.user-ratings.edit',['id' => $job->id]);
                    }
                    //else redirect to edit
                    else {
                        return redirect()->to('jobs/'.$job->slug);
                    }
                }
                //if there are no freelancers or job status is not 'in progress'
                else {
                    return redirect()->to('jobs/'.$job->slug);
                }

            }
            else
            {     //redirect back to job
                return redirect()->to('jobs/'.$job->slug)->with('edit_success', 'You have successfully edited your job.');

            }



        // if there does not exist that job or user is wrong, return error page
        } else {
            return abort(404);

        }


    }

    /**
     * Remove the specified job from database.
     *
     * @param  int  $id id of the job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get the logged in user id
        $userId = Auth::id();
            // if there exists job
            if( Job::where([['id', $id]])->exists() ) {

            // get the job
            $job = Job::findOrFail($id);

                // if the user is not the owner
                if($job->user_id != Auth::id()) {
                    $return = array(
                        'error' => 'You are not allowed to execute this action!'
                    );
                    return response()->json($return, 403);
                }

                if($job->job_status_id == 2) {
                    $return = array(
                        'error' => "You can't delete this job for it is in 'Done' state."
                    );
                    return response()->json($return, 404);
                }

                // get the job file id
                $job_file_id = JobFile::where('job_id', $id)->select('id')->get();

                    // if there is file
                    if(!$job_file_id->isEmpty()) {
                        // get the path
                        $filePath = public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job->id.'/'.$job->job_files->path;

                        // check for file  and delete folder/file if exists
                        if( file_exists($filePath)) {
                            //delete folder
                             File::deleteDirectory(public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job->id);
                        }
                    }

                    // delete job afterwards so we can use realtion to get the file in the 'if' before
                    $job->delete();

                    // return ok status, because ajax
                    $return = array(
                        'success' => 'You have successfully deleted this job!'
                    );
                    return response()->json($return, 200);
            }
            // return error
            else {
                $return = array(
                    'error' => 'This job does not exist in database!'
                );
                return response()->json($return, 400);
            }

    }


    /**
     * Method which returns filtered jobs
     * @param Request $request Request object containing info about filter
     */
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
                    $query->orWhere('job_location_country', 'like', '%'.$location.'%');
                    $query->orWhere('job_location_city', 'like', '%'.$location.'%');
                }
            });
        })
        ->when($request->input('category'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $categories = explode(' ', $request->input('category'));
                foreach ($categories as $category) {
                    $query->orWhereHas('job_business_categories', function ($query) use ($category){
                    $query->join('business_categories', 'job_business_categories.business_category_id', 'business_categories.id');
                    $query->select('business_categories.id', 'name', 'job_id');
                    $query->where('name', 'like', '%'.$category.'%');
                });
                }
            });
        })
        ->with([
        'job_skills',
        'job_status',
        'job_business_categories',
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['job_likes', 'job_comments'])
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('frontend.jobs', compact('jobs', 'request'));
    }

     /**
     * Method which returns filtered user jobs
     * @param Request $request Request object containing info about filter
     */
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
        ->when($request->input('category'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $categories = explode(' ', $request->input('category'));
                foreach ($categories as $category) {
                    $query->orWhereHas('job_business_categories', function ($query) use ($category){
                    $query->join('business_categories', 'job_business_categories.business_category_id', 'business_categories.id');
                    $query->select('business_categories.id', 'name', 'job_id');
                    $query->where('name', 'like', '%'.$category.'%');
                });
                }
            });
        })
        ->with([
        'job_skills',
        'job_status',
        'job_business_categories',
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['job_likes', 'job_comments'])
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('frontend.user_jobs', compact('jobs', 'request'));
    }



    /**
     * Get all posts for specified user id.
     *
     * @param  string  $slug User slug
     * @return \Illuminate\Http\Response
     */
    public function getMyJobs($slug)
    {

        $jobs = Job::
        where('user_id', Auth::id())
        ->withCount('job_comments','job_likes', 'job_applications')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc')-> paginate(5);

        return view('frontend.user_jobs', compact('jobs'));
    }



    /**
     * Method used to delete file from job
     * @param $request request object
     */
    public function deleteJobFile(Request $request) {


        // id of the file
        $file_id = $request['file_id'];

        $job_file = JobFile::findOrFail($file_id);

        $job = Job::findOrFail($job_file->job_id);

        // check if file exists
        if ($job_file->exists()) {

            // if file exists but the user is not thw owner of the job
            if($job->user_id != Auth::id()) {
                $return = array(
                    'error' => 'You are not allowed to execute this action!'
                );
                return response()->json($return, 403);
            }
            //delete folder
            File::deleteDirectory(public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job_file->job_id);
            // delete from DB
            $job_file->delete();
            $return = array(
                'success' => 'You have successfully deleted this file!'
            );
            return response()->json($return, 200);
        }else {
            $return = array(
                'error' => 'Error deleting while file!'
            );
            return response()->json($return, 404);
        }

    }




}
