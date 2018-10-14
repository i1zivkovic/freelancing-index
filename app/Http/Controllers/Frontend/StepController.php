<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use Auth;
use Image;
use App\UserSkill;
use Carbon\Carbon;

class StepController extends Controller
{


    public function getStepOne(){

        return view('frontend.step-one');
    }

    public function postStepOne(Request $r){

        $profile = Profile::updateOrCreate(['user_id' => Auth::id()], $r->all());


        if(!empty($r->file('image'))){
            $image = $this->uploadImage($r->file('image'), Auth::user()->username);
            $profile->update(['image_url' => $image]);
        }

        return redirect(route('frontend.getStepTwo'));

    }

    public function getStepTwo(){
        return view('frontend.step-two');
    }

    public function postStepTwo(Request $r){
        $arr = [];
        $skills = $r->tag_list;

        if(empty($skills))
            return redirect(route('frontend.getProfile'));

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

        return redirect(route('frontend.getProfile'));
    }

    public function uploadImage($file, $folder){

        if (!is_dir(public_path().'/uploads/'.$folder)) {
            mkdir(public_path().'/uploads/'.$folder, 0777, true);
            mkdir(public_path().'/uploads/'.$folder.'/thumb', 0777, true);
        }

        $destinationPath = public_path().'/uploads/'.$folder.'/';
        $destinationPathThumb = public_path().'/uploads/'.$folder.'/thumb/';

        $file_name = time().'-'.$file->getClientOriginalName();

        $image = Image::make($file);

        $image->resize(1920, 1280, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $file_name);

        $image->resize(350, 280, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumb . $file_name);

        return $file_name;
    }
}
