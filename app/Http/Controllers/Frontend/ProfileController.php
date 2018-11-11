<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;
use Validator;

use App\ProfileEducation;
use App\ProfileExperience;
use App\Profile;
use App\User;
use App\UserSkill;
use App\Social;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Update profile experiences
    public function update_profile_experience(Request $request) {

        //get all data from request
        $data = $request->all();

        //if input is not empty
        if(!empty($request->input('company_name'))){

            // loop through each because it will be an array of values (multiple forms)
            foreach($data['company_name'] as $index => $company_name){

                // create rules
                $rules['company_name.' .$index] = 'max:100|required';
                $rules['job_title.' .$index] = 'max:100|required';
                $rules['job_description.' .$index] = 'max:4000';
                $rules['job_location_country.' .$index] = 'max:100';
                $rules['job_location_city.' .$index] = 'max:100';
                $rules['start_date.' .$index] = 'date|required';
            }
        }

        // make validator
        $validator = Validator::make($data, $rules);

        // validate
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with(array('active-tab' => 'experiences'));
        }

        // delete existing entries
        ProfileExperience::where('profile_id', $data['profile_id'])->delete();

        // create new entries
        foreach($data['company_name'] as $key => $company_name){
            ProfileExperience::create([
                'profile_id' => $data['profile_id'],
                'company_name' => $company_name,
                'start_date' => $data['start_date'][$key],
                'end_date' => $data['end_date'][$key],
                'job_title' => $data['job_title'][$key],
                'job_description' => $data['job_description'][$key],
                'job_location_city' => $data['job_location_city'][$key],
                'job_location_country' => $data['job_location_country'][$key]
            ]);
        }

        // set active tab
        $active_tab = 'experiences';

        // redirect with success
        return redirect()->back()->with(array('experience_success' => 'Work experiences updated successfully!', 'active-tab' => $active_tab));
    }




    // method used to update profile education
    public function update_profile_education(Request $request) {
        // get all data from request
        $data = $request->all();
        // check if inputs exist
        if(!empty($request->input('institution_name'))){
            // since it will be array, loop through each
            foreach($data['institution_name'] as $index => $institution_name){
                // create rules
                $rules['institution_name.' .$index] = 'max:100|required';
                $rules['major.' .$index] = 'max:100|required';
                $rules['degree.' .$index] = 'max:100|required';
                $rules['description.' .$index] = 'max:4000|required';
                $rules['start_date.' .$index] = 'date|required';
            }
        }

        // create validator
        $validator = Validator::make($data, $rules);

        // validate
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with(array('active-tab' => 'education'));
        }

        // delete existing entries
        ProfileEducation::where('profile_id', $data['profile_id'])->delete();

        // create new
        foreach($data['institution_name'] as $key => $institution_name){
            ProfileEducation::create([
                'profile_id' => $data['profile_id'],
                'institution_name' => $institution_name,
                'start_date' => $data['start_date'][$key],
                'end_date' => $data['end_date'][$key],
                'description' => $data['description'][$key],
                'degree' => $data['degree'][$key],
                'major' => $data['major'][$key]
            ]);
        }
            // set active tab
        $active_tab = 'education';

        // redirect
        return redirect()->back()->with(array('education_success' => 'Education info updated successfully!', 'active-tab' => $active_tab));
    }


    // method used to update base profile info
    public function update_profile_info (Request $request) {



             // Validation rules
             $rules = [
                'gender' => 'required|max:1',
                'date_of_birth' => 'required|date',
                'about_me' => 'max:1000',
                'website_url' => 'max:500',
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'contact_number' => 'max:20'
            ];

            // create validator with given rules and check request
            $validator = Validator::make($request->all(), $rules);

            // check if validation succeeds
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with(array('active-tab' => 'profile-info'));

            }

            // if validation is successful, get the profile
            $profile = Profile::where('user_id', Auth::id())->firstOrFail();

            // check for uploaded file
            if(!empty($request->file('image_url'))){
                if($profile->image_url) {
                 $fileCheck = public_path().'/uploads/'.Auth::user()->username.'/'.$profile->image_url;
                 if( file_exists($fileCheck) ) {
                unlink($fileCheck);
                  }
                 }
            $file = $this->uploadImage($request->file('image_url'), Auth::user()->username);
            $profile->update(['image_url' => $file]);
              }

            // update profile
            $profile->update($request->except('image_url'));

            // set active tab
            $active_tab = 'profile-info';

             // redirect
            return redirect()->back()->with(array('profile_success' => 'Profile info updated successfully!', 'active-tab' => $active_tab));
    }


    // method used to update base user info
    public function update_account_info (Request $request) {

         // Validation rules
         $rules = [
            'username' => 'required|string|max:20|min:5|unique:users,username, '.Auth::id() ,
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id()
        ];


        if($request->get('password') || $request->get('password_confirmation')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $notify_applications = $request->get('notify_applications');
        $notify_application_status = $request->get('notify_application_status');

        // create validator with given rules and check request
        $validator = Validator::make($request->all(), $rules);

        // check if validation succeeds
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with(array('active-tab' => 'account-info'));
        }


        // get the user
        $user = User::findOrFail(Auth::id());

        // update it
        if($request->get('password')) {
            $user->update($request->except(['password'])+['slug'=> str_slug($request->get('username'), '-').time() , 'password' => Hash::make($request['password']), 'notify_applications' => $notify_applications ? $notify_applications : 0, 'notify_application_status' => $notify_application_status ? $notify_application_status : 0]);
        } else {
            $user->update($request->except(['password'])+['slug'=> str_slug($request->get('username'), '-').time(), 'notify_applications' => $notify_applications ? $notify_applications : 0, 'notify_application_status' => $notify_application_status ? $notify_application_status : 0]);
        }


        $active_tab = 'account-info';
          // redirect
          return redirect()->route('frontend.profileEdit', ['slug' => $user->slug])->with(array('account_success' => 'Account info updated successfully!', 'active-tab' => $active_tab));

    }



    //method used to update user skills
    public function skills_update(Request $request) {
        // create empty array
        $arr = [];

        //get the skills from request
        $skills = $request->skill_list;

        //get necessary data for update
        $now = Carbon::now();
        $user_id = Auth::id();
        $existing_skills = UserSkill::where('user_id', $user_id)->exists();

        // if there are some skills already
        if($existing_skills){
            //delete them
            UserSkill::where('user_id', $user_id)->delete();
        }

        // for each skill in skill list, create object and wrap in array
        for ($i = 0; $i < count($skills); $i++) {
            array_push($arr, ['skill_id' => $skills[$i], 'user_id' => $user_id, 'created_at' => $now, 'updated_at' => $now]);
        }

        // bulk insert
        UserSkill::insert($arr);

        // set active tab
         $active_tab = 'skills';
          // redirect
          return redirect()->route('frontend.profileEdit', ['slug' => Auth::user()->slug])->with(array('skills_success' => 'Skills updated successfully!', 'active-tab' => $active_tab));
    }





    //method used to update user socials
    public function socials_update(Request $request) {

        $socials = Social::findOrFail(Auth::id());
        $socials->update($request->all());
        $active_tab = 'socials';
          // redirect
          return redirect()->route('frontend.profileEdit', ['slug' => Auth::user()->slug])->with(array('socials_success' => 'Socials updated successfully!', 'active-tab' => $active_tab));
    }



    //method used to upload profile image
    public function uploadImage($file, $folder){

        //
        ini_set('memory_limit','-1');

        if (!is_dir(public_path().'/uploads/'.$folder)) {
            mkdir(public_path().'/uploads/'.$folder, 0777, true);
        }

        $destinationPath = public_path().'/uploads/'.$folder.'/';

        $file_name = time().'-'.$file->getClientOriginalName();

        $image = Image::make($file);
        $image->orientate();


        $image->save($destinationPath . $file_name);

        return $file_name;
    }



}
