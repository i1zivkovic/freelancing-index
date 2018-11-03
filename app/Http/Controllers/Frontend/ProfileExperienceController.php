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
            $company_names = count($request->input('company_name'));
            foreach(range(0, $company_names) as $index) {
                $rules['company_name.' .$index] = 'min:100|required';
            }
        }

        $validator = Validator::make($data, $rules);

       /*  dd($validator); */

        if ($validator->fails()) {
           /*  dd($validator); */
            return back()->withErrors($validator)->withInput();
        }

    }

}
