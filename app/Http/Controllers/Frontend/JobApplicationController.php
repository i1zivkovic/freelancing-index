<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Mail;
use App\Job;
use Carbon\Carbon;
use App\JobApplication;

class JobApplicationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                $job_owner_mail = Job::with([
                    'user' => function($query) {
                        $query->select('email', 'id');
                    }
                    ])
                    ->findOrFail($job_id);

                    $mail_data = array (
                        'user_email' => $job_owner_mail->user->email,
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
                $jobApplication = new JobApplication;
                $jobApplication->user_id = $user_id;
                $jobApplication->job_id = $job_id;
                $jobApplication->comment = $comment;
                $jobApplication->job_application_state_id = 1;
                $jobApplication->save();

                // send e-mail
                Mail::send('e-mails.job_application', ['slug' => $job_slug, 'user_slug' => Auth::user()->slug], function($msg) use ($mail_data){
                    $msg->from(Auth::user()->email, 'TheHunt');
                    $msg->subject('Job Application');
                    $msg->to($mail_data['user_email']);
                });

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if( JobApplication::where('id', $id)->exists() )
        {


            // get the job application
            $job_application = JobApplication::findOrFail($id);

            // get the owner of the job
            $job_owner = Job::select('id','user_id')->findOrFail($job_application->job_id);

            // if the owner of the job is calling this action
            if($job_owner->user_id == Auth::id()){

                $job_application_state_id = $request->get('application_state_id');
                $job_application_state_name = ($job_application_state_id == "2") ? 'accepted' : 'rejected';

                $job_application->job_application_state_id = (int)$job_application_state_id;
                $job_application->save();

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
     * @param  int  $job_id
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
            ->get();


           /*  dd($job_applications); */

        return view('frontend.user_applications', compact('job_applications'));
    }
}
