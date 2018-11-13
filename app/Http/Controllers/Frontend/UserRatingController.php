<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Job;
use App\UserRating;
use App\JobApplication;
use Validator;
use Auth;
use Carbon\Carbon;

class UserRatingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if there exists job that currently logged in user is owner of (automatically checks if the logged in user is owner of the job)
        if( Job::where([['user_id', Auth::id()], ['id', $request->get('job_id')]])->exists() ) {
        // get all data from request
        $data = $request->all();
            // custom messages
        $customMessages = [];
        // check if inputs exist
        if(!empty($request->input('rating'))){
            // since it will be array, loop through each
            foreach($data['rating'] as $index => $rating){
                // create rules
                $rules['rating.' .$index] = 'max:5|min:1|required';
                $rules['comment.' .$index] = 'max:1000|min:20|required';
                $customMessages['comment.'.$index.'.min'] = 'Comment must be at least 20 characters.';
                $customMessages['comment.'.$index.'.max'] = 'Comment is too long (1000 characters max).';
                $customMessages['rating.'.$index.'.min'] = 'Rating must be at least "1".';
                $customMessages['rating.'.$index.'.max'] = 'Rating max. is "5"';
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
            array_push($userRatings, ['rating' => $request->rating[$i], 'recruiter_id' => Auth::id(), 'freelancer_id' => $request->freelancer_id[$i] ,'comment' => $request->comment[$i], 'job_id' => $request->job_id ,'created_at' => $now, 'updated_at' => $now]);
        }

        // bulk insert
        UserRating::insert($userRatings);

          // redirect
          return redirect()->route('frontend.home')->with('success','You have successfully rated users');


        }
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

        $ratings = UserRating::where('freelancer_id',$freelancer->id)->with([
        'job',
        'recruiter.userProfile'
        ])->get();

       /*  dd($ratings); */
        return view('frontend.user_ratings',compact('ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $job_id Job id
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id)
    {

        if(UserRating::where('job_id', $job_id)->exists()){
            return redirect()->back()->with('error_edit', 'You have already rated users for this job!');
        }
         // if there exists job that currently logged in user is owner of (automatically checks if the logged in user is owner of the job)
         if( Job::where([['user_id', Auth::id()], ['id', $job_id]])->exists() ) {

            $freelancers_id = JobApplication::where([['job_id',$job_id], ['job_application_state_id', 2]])->select('user_id')->get();
            $freelancers = User::with(['userProfile' => function($query){
                $query->select('id','user_id', 'first_name', 'last_name');
            }])->whereIn('id',$freelancers_id)->select('username','id', 'slug')->get();

            // return view
            return view('frontend.rate', compact('freelancers', 'job_id'));
         }
         //if not , show 404 page
         else {
            return abort(404);
         }
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
}
