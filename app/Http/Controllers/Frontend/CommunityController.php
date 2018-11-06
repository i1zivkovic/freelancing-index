<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class CommunityController extends Controller
{
    //
    public function index() {

        // paginate users
        $users = User::with('userProfile')
        ->paginate(10);


        return view('frontend.users');
    }
}
