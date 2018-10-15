<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;

class UserController extends Controller
{
    //
    public function getProfile(){
        $user = User::
        with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->findOrFail(Auth::id());
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail(Auth::id());
        return view('frontend.profile', compact('user','profile'));
    }
}
