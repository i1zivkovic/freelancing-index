<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;
use Validator;

use App\ProfileExperience;
use Illuminate\Http\Request;

class ProfileExperienceController extends Controller
{
    //

    public function update(Request $request) {


        $data = $request->all();
 
        if(!empty($request->input('company_name'))){
            foreach($data['company_name'] as $index => $company_name){
                $rules['company_name.' .$index] = 'max:100|required';
                $rules['job_title.' .$index] = 'max:100|required';
                $rules['job_description.' .$index] = 'max:4000|required';
                $rules['job_location_country.' .$index] = 'max:100';
                $rules['job_location_city.' .$index] = 'max:100';
                $rules['start_date.' .$index] = 'date|required';
                $rules['end_date.' .$index] = 'date|required';
            }
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            dd($validator);
           /*  dd($validator); */
            return back()->withErrors($validator)->withInput();
        }

        ProfileExperience::where('profile_id', $data['profile_id'])->delete();

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

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

}
