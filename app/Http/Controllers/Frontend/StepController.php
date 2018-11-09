<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use Auth;
use Image;
use Validator;
use App\UserSkill;
use Carbon\Carbon;

class StepController extends Controller
{

    // method used to get the step one view
    public function getStepOne(){

        return view('frontend.step_one');
    }

    /**
     * method used to store data from step one
     * @param Request $r request object containing data from step one form
     *  */ 
    public function postStepOne(Request $r){


             // Validation rules
             $rules = [
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'date_of_birth' => 'required|date',
                'about_me' => 'max:1000',
                'website_url' => 'max:500',
                'contact_number' => 'max:50',
            ];

            // create validator with given rules and check request
            $validator = Validator::make($r->all(), $rules);

            // check if validation succeeds
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // update or create profile
        $profile = Profile::updateOrCreate(['user_id' => Auth::id()], $r->all());


        // if there is image set in file input
        if(!empty($r->file('image'))){
            $image = $this->uploadImage($r->file('image'), Auth::user()->username);
            $profile->update(['image_url' => $image]);
        }

        // return step two view
        return redirect(route('frontend.getStepTwo'));

    }

    // method used to get step two view
    public function getStepTwo(){
        return view('frontend.step_two');
    }

    /**
     * method used to store data from step two
     * @param Request $r request object containing data from step two form
     *  */ 
    public function postStepTwo(Request $r){


        $arr = [];
        $skills = $r->skill_list;

        // if there are no skills set, redirect to user profile
        if(empty($skills))
            return redirect(route('frontend.user.show',Auth::user()->slug));

        // else store them in db
        $now = Carbon::now();
        $user_id = Auth::id();
        $skills_exist = UserSkill::where('user_id', $user_id)->exists();

        if($skills_exist){
            UserSkill::where('user_id', $user_id)->delete();
        }

        for ($i = 0; $i < count($skills); $i++) {
            array_push($arr, ['skill_id' => $skills[$i], 'user_id' => $user_id, 'created_at' => $now, 'updated_at' => $now]);
        }

        UserSkill::insert($arr);

        // redirect to the user
        return redirect(route('frontend.user.show',Auth::user()->slug));
    }

    /**
     * Method used to upload profile image
     * @param $file File 
     * @param $folder Foler name
     */
    public function uploadImage($file, $folder){

        // remove memory limit
        ini_set('memory_limit','-1');

        // if there is no folder, create one with all permissions
        if (!is_dir(public_path().'/uploads/'.$folder)) {
            mkdir(public_path().'/uploads/'.$folder, 0777, true);
        }

        $destinationPath = public_path().'/uploads/'.$folder.'/';

        $file_name = time().'-'.$file->getClientOriginalName();

        $image = Image::make($file);
        $image->orientate();


        $image->save($destinationPath . $file_name);


        // return file name
        return $file_name;
    }
}
