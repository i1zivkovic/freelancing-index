<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;

class UserController extends Controller
{
    public function show($slug){
        $user = User::
        where('slug', $slug)
        ->with(['userProfile', 'userSocial', 'userLocation', 'userSkills'])
        ->firstOrFail();
        $profile =  Profile::with(['profileEducation','profileExperience']) -> findOrFail($user->id);
        return view('frontend.profile', compact('user','profile'));
    }
}
