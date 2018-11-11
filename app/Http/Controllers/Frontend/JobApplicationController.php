<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Mail;
use App\User;
use App\Job;
use Carbon\Carbon;
use App\JobApplication;
use App\JobApplicationState;

class JobApplicationController extends Controller
{

    /**
     * Store a newly created job application.
     *
     * @param  \Illuminate\Http\Request  $request containing info abour application
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             // get the data used to verify application
            $job_id = (int)$request->get('job_id');
            $user_id = Auth::id();

            // If user has already applied
            if(JobApplication::where([['user_id', $user_id], ['job_id',$job_id]])->exists()){
                return back()->with('alreadyApplied', 'You have already applied to this job.');
            } else {


                // get the data used to store application and e-mail
                $comment = $request->get('comment');
                $job_slug = Job::select('slug')->findOrFail($job_id);
                $recruiter_mail = Job::with([
                    'user' => function($query) {
                        $query->select('email', 'id', 'notify_applications');
                    }
                    ])
                    ->findOrFail($job_id);

                    //data used to send e-mail
                    $mail_data = array (
                        'user_email' => $recruiter_mail->user->email,
                        'job_slug' => $job_slug
                    );


             // Validation rules
             $rules = [
                'comment' => 'required|max:1000|min:30',
            ];

            // create validator with given rules and check request
            $validator = Validator::make($request->all(), $rules);

            // check if validation succeeds
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

                //create job application
                $jobApplication = new JobApplication;
                $jobApplication->user_id = $user_id;
                $jobApplication->job_id = $job_id;
                $jobApplication->comment = $comment;
                $jobApplication->job_application_state_id = 1;
                $jobApplication->save();

                // send e-mail if user has set notifications to true
                if($recruiter_mail->user->notify_applications) {
                    Mail::send('e-mails.job_application', ['slug' => $job_slug, 'user_slug' => Auth::user()->slug], function($msg) use ($mail_data){
                        $msg->from(Auth::user()->email, 'TheHunt');
                        $msg->subject('Job Application');
                        $msg->to($mail_data['user_email']);
                    });
                }
                return back()->with('success', 'You have successfully appllied to this job!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get job info
        $job = Job::select('slug','id')->findOrFail($id);

        // return view with job info
        return view('frontend.job_application', compact('job'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id Id of the job application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if( JobApplication::where('id', $id)->exists() )
        {
            // get the job application
            $job_application = JobApplication::findOrFail($id);

            // get the id of the job owner from the job table based on the job application
            $recruiter = Job::select('id','user_id')->findOrFail($job_application->job_id);

            // get the applied freelancer e-mail
            $freelancer = User::select('id','email', 'notify_application_status')->findOrFail($job_application->user_id);

            // get the job slug used for e-mail
            $job_slug = Job::select('id','slug')->findOrFail($job_application->job_id);

            //get the job application state name
            $job_application_state = JobApplicationState::select('id','state')->findOrFail($request->get('application_state_id'));

            // if the owner of the job is calling this action
            if($recruiter->user_id == Auth::id()){

                $job_application_state_id = $request->get('application_state_id');
                $job_application_state_name = ($job_application_state_id == "2") ? 'accepted' : 'rejected';

                $job_application->update(['job_application_state_id' =>  (int)$job_application_state_id]);

                // send e-mail if user has set notifications to true
                if($freelancer->notify_application_status) {
                    Mail::send('e-mails.job_application_response', ['job_slug' => $job_slug, 'job_application_state' => $job_application_state], function($msg) use ($freelancer){
                        $msg->from(Auth::user()->email, 'TheHunt');
                        $msg->subject('Job Application Status Change');
                        $msg->to($freelancer['email']);
                    });
                }

                $return = array(
                    'success' => 'You have successfully '.$job_application_state_name.' this job application',
                    'verb' => $job_application_state_name
                );
                return response()->json($return, 200);

            }
            // if the owner id does not match the currently logged in user_id
            else {
                $return = array(
                    'error' => 'You are not allowed to execute this action.'
                );
                 return response()->json($return, 403);
            }
        }
        // if there is no job_application
        else {
            $return = array(
                        'error' => 'This job application does not exist in database.'
                    );
            return response()->json($return, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $job_id Id of the job
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_id)
    {

        $application = JobApplication::where([
            ['job_id', $job_id],
            ['user_id', Auth::id()]
            ])->first();

        if($application) {
            $application->delete();
            return back()->with('successRemove', 'You have successfully removed your job application.');
        }
        else {
            return abort(404);
        }
    }


    /**
     * Method used to display user applications
     */
    public function userApplications() {

        $job_applications = JobApplication::where([['user_id', Auth::id()]])
            ->with([
            'job_application_state',
            'job.user'
            ])
        ->paginate(10);


           /*  dd($job_applications); */

        return view('frontend.user_applications', compact('job_applications'));
    }

    /**
     * Method used to display manage applications
     */
    public function manageApplications() {

        $job_ids = Job::where([['user_id', Auth::id()], ['job_status_id', 1]])->select('id')->get();

        $job_applications = JobApplication::whereIn('job_id',$job_ids)
            ->with([
            'user',
            'job'
            ])
            ->paginate(10);

        $jobs = Job::where('user_id', Auth::id())
            ->select('id', 'title', 'slug')
            ->get();


        return view('frontend.manage_applications', compact('jobs', 'job_applications'));
    }

    /**
     * Method used to display manage applications page by job slug
     * @param string $slug Job Slug
     */
    public function manageApplicationsSlug($slug) {

        $selected_job = Job::where([['slug', $slug], ['job_status_id', 1]])->select('id')->firstOrFail();

        $job_applications = JobApplication::where('job_id',$selected_job->id)
            ->with([
            'user',
            'job_application_state'
            ])
            ->paginate(10);

        $jobs = Job::where('user_id', Auth::id())
            ->select('id', 'title', 'slug')
            ->get();


        return view('frontend.manage_applications', compact('jobs', 'job_applications', 'selected_job'));
    }
}
