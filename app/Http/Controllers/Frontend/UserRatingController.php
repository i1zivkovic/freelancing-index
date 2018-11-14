<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Job;
use App\JobApplication;
use App\User;
use App\UserRating;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class UserRatingController extends Controller
{

    /**
     * Store a newly created rating/s for freelancer/s.
     *
     * @param  \Illuminate\Http\Request  $request contains freelancer info and job id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if there exists job that currently logged in user is owner of (automatically checks if the logged in user is owner of the job)
        if (Job::where([['id', $request->get('job_id')]])->exists()) {

            //get the recruiter id
            $recruiter = Job::where('id', $request->get('job_id'))->select('user_id')->firstOrFail();

            // if they match
            if ($recruiter->user_id == Auth::id()) {

                // if user hasn't rated for this job already
                if (!UserRating::where([['user_id', Auth::id()], ['job_id', $request->get('job_id')]])->exists()) {
                    // get all data from request
                    $data = $request->all();
                    // custom messages
                    $customMessages = [];
                    // check if inputs exist
                    if (!empty($request->input('rating'))) {
                        // since it will be array, loop through each
                        foreach ($data['rating'] as $index => $rating) {
                            // create rules
                            $rules['rating.' . $index] = 'max:5|min:1|required';
                            $rules['comment.' . $index] = 'max:1000|min:20|required';
                            $customMessages['comment.' . $index . '.min'] = 'Comment must be at least 20 characters.';
                            $customMessages['comment.' . $index . '.max'] = 'Comment is too long (1000 characters max).';
                            $customMessages['rating.' . $index . '.min'] = 'Rating must be at least "1".';
                            $customMessages['rating.' . $index . '.max'] = 'Rating max. is "5"';
                        }
                    }

                    // create validator
                    $validator = Validator::make($data, $rules, $customMessages);

                    // validate
                    if ($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                    }

                    //get necessary data for update
                    $now = Carbon::now();

                    //create an array of ratings for bulk insert
                    $userRatings = [];

                    // create user rating objects
                    for ($i = 0; $i < count($request->rating); $i++) {
                        array_push($userRatings, ['rating' => $request->rating[$i], 'user_id' => Auth::id(), 'rated_user_id' => $request->freelancer_id[$i], 'comment' => $request->comment[$i], 'job_id' => $request->job_id, 'created_at' => $now, 'updated_at' => $now]);
                    }

                    // bulk insert
                    UserRating::insert($userRatings);

                    // redirect
                    return redirect()->route('frontend.home')->with('success', 'You have successfully rated users');
                }

                // if user has already rated freelancers for this job
                else {
                    return redirect()->back()->with('rating_error', 'You have already rate the users for this job!');
                }

            }
            // if user is not the owner of the job
            else {
                return abort(403);
            }

        }
        // if the job does not exist
        else {
            return abort(404);
        }

    }

    /**
     * Display the specified user ratings.
     *
     * @param  string $slug User slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $freelancer = User::where('slug', $slug)->firstOrFail();

        $ratings = UserRating::where('rated_user_id', $freelancer->id)->with([
            'job',
            'recruiter.userProfile',
        ])->get();

        /*  dd($ratings); */
        return view('frontend.user_ratings', compact('ratings'));
    }

    /**
     * Show the form for editing the freelancers rating.
     *
     * @param  int  $job_id Job id
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id)
    {

        // if there exists job that currently logged in user is owner of (automatically checks if the logged in user is owner of the job)
        if (Job::where([['id', $job_id]])->exists()) {
            //get the job
            $job = Job::findOrFail($job_id);

            // if job is 'Done
            if ($job->job_status_id == 2) {

                if ($job->user_id == Auth::id()) {

                    if (UserRating::where('job_id', $job_id)->exists()) {
                        return redirect()->back()->with('error_edit', 'You have already rated users for this job!');
                    }

                    $freelancers_id = JobApplication::where([['job_id', $job_id], ['job_application_state_id', 2]])->select('user_id')->get();
                    $freelancers = User::with(['userProfile' => function ($query) {
                        $query->select('id', 'user_id', 'first_name', 'last_name');
                    }])->whereIn('id', $freelancers_id)->select('username', 'id', 'slug')->get();

                    // return view
                    return view('frontend.rate', compact('freelancers', 'job_id'));

                } else {
                    return abort(403);
                }
            } else {
                return abort(403);
            }

        }
        //if not , show 404 page
        else {
            return abort(404);
        }
    }
    /**
     * Show the form for editing recrutier rating.
     *
     * @param  int  $job_id Job Id
     * @param int $recuiter_id Recruiter ID
     * @return \Illuminate\Http\Response
     */
    public function edit_recruiter($job_id, $recuiter_id)
    {

        // if there exists job that currently logged in user is owner of
        if (Job::where([['id', $job_id]])->exists()) {

            //get the job
            $job = Job::findOrFail($job_id);

            // if job is 'Done
            if ($job->job_status_id == 2) {

                // if owner is NOT loged in user (so he can't rate himself)
                if ($job->user_id != Auth::id()) {
                    // check to see if logged in user has a job application to this job and is in state 'Accepted' and if recruiter exists (and so will then a job)
                    if (JobApplication::where([['user_id', Auth::id()], ['job_id', $job_id], ['job_application_state_id', 2]])->exists() && User::where('id', $recuiter_id)->exists()) {
                        $recruiter = User::with(['userProfile' => function ($query) {
                            $query->select('id', 'user_id', 'first_name', 'last_name');
                        }])->select('username', 'id', 'slug')->findOrFail($recuiter_id);

                        $job_id = $job_id;

                        // return view
                        return view('frontend.recruiter_rate', compact('recruiter', 'job_id'));
                    }
                    //if not , show 404 page
                    else {
                        return abort(404);
                    }
                }
                // if user IS the owner of the job (which would mean he will rate himself)
                else {
                    return abort(403);
                }
            }
            //if job is not 'Done'
            else {
                return abort(403);
            }
        }
        //if there is no job
        else {
            return abort(404);
        }

    }

    /**
     * Store a newly created rating for recruiter.
     *
     * @param  \Illuminate\Http\Request  $request Contains job id and recruiter info
     * @return \Illuminate\Http\Response
     */
    public function store_recruiter(Request $request)
    {

        // if rated user in meantime didn't delete his account
        if (User::where('id', $request->get('rated_user_id'))->exists()) {

            if (!UserRating::where([['user_id', Auth::id()], ['rated_user_id', $request->get('rated_user_id')], ['job_id', $request->get('job_id')]])->exists()) {

                // set validation rules
                $rules = [
                    'rating' => 'required|max:5|min:1',
                    'comment' => 'max:1000|min:20|required',
                ];

                // create validator
                $validator = Validator::make($request->all(), $rules);

                // validate
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                //create new rating
                UserRating::create($request->except(['job_id']) + ['user_id' => Auth::id(), 'job_id' => ($request->get('job_id') ? $request->get('job_id') : null)]);

                // redirect
                return redirect()->route('frontend.home')->with('success', 'You have successfully rated the user');

            } else {
                return redirect()->back()->with('recruiter_rating_error', 'You have already rated this user!');
            }

        }
        //if he did
        else {
            return redirect()->back()->with('recruiter_rating_error', 'This user has deleted his account in the meantime!');
        }
    }

}
