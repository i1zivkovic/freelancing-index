<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Auth;

class CommunityController extends Controller
{
    // Method used to fetch users
    public function index() {

        // paginate users
        $users = User::with(['userProfile', 'userLocation', 'userSkills', 'followers'])
        // if they have confirmed their e-mail
        ->where('email_verified_at', '<>',null)
        ->paginate(10);

        /* dd($users); */

        return view('frontend.users', compact('users'));
    }

    public function show_followers (){
        // get array of followers ids
        $followers_ids = Follow::where('user_id',Auth::id())->select('follower_id')->get();
        // get their data
        $followers = User::whereIn('id', $followers_ids)->with(['userProfile', 'userLocation', 'userSkills', 'followers'])->paginate(10);

        return view('frontend.user_followers', compact('followers'));

    }

    public function show_following (){
         // get array of ids of people user is following
         $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

        // get their data
         $following = User::whereIn('id', $following_ids)->with(['userProfile', 'userLocation', 'userSkills', 'followers'])->paginate(10);

        return view('frontend.user_following', compact('following'));

    }


    /**
     * Method used to follow or unfollow user
     * @param request contains info about action
     * @param id Id of the user being followed
     */
    public function follow_unfollow(Request $request, $id){
        //get action name
        $action = $request->get('action');
        switch ($action) {
            case 'Follow':

            // if user already follows another user
            if( Follow::where([['user_id', $id], ['follower_id', Auth::id()]])->exists() ) {
                $return = array(
                    'error' => 'You are already following this user!'
                );
                return response()->json($return, 400);
            }
            // if users tries to follow himself
            else if( $id == Auth::id() )
            {
                $return = array(
                    'error' => 'You can not follow yourself!'
                );
                return response()->json($return, 400);
            }
            // if there is no record
            else {
                $follow = new Follow;
                $follow->user_id = (int)$id;
                $follow->follower_id = Auth::id();
                $follow->save();
                $return = array(
                    'success' => 'You have successfully followed this user!'
                );
                return response()->json($return, 200);
                break;
            }
            //  CASE UNLIKE
            case 'Unfollow':
            // if there exists this follow
            if( Follow::where([['user_id', $id], ['follower_id', Auth::id()]])->exists() ) {
                // delete
                Follow::where([['user_id', $id],['follower_id',Auth::id()]])->delete();
                $return = array(
                    'success' => 'You have successfully unfollowed this user!'
                );
                return response()->json($return, 200);
                }
                // throw error
                else
                 {
                    $return = array(
                        'error' => 'This follow does not exist in database!'
                    );
                    return response()->json($return, 400);
                }
        }
    }



    /**
     * Method used to filter users
     * @param request Request objects, contains keywords and locations if there are any
     */
    public function users_filter(Request $request){
        $users = User::
        // filter only verified users , instead it will throw error on slug/profile info/etc because it is set on 1st step..
        where('email_verified_at', '<>',null)
        // when there are keywords entered
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            // look for user with that username , no need for explode cause username is without spaces
            $query->where('username', 'like', '%'.$request->input('q').'%');
            // explode keywords
            $keywords = explode(' ', $request->input('q'));
            // for each keyword, check if it matches first name or last name
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('userProfile', function ($query) use ($keyword){
                        $query->select('*');
                        $query->where('username', 'like', '%'.$keyword.'%');
                        $query->orWhere('first_name', 'like', '%'.$keyword.'%');
                        $query->orWhere('last_name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        // when there is input in location field
        ->when($request->input('location'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
                //explode keywords
            $locations = explode(' ', $request->input('location'));
            // check if keyword matched city or country
                foreach ($locations as $location) {
                    $query->orWhereHas('userLocation', function ($query) use ($location){
                    $query->select('*');
                    $query->where('city', 'like', '%'.$location.'%');
                    $query->orWhere('country', 'like', '%'.$location.'%');
                });
                }
            });
        })
        ->with([
            'userProfile', 'userLocation', 'userSkills', 'followers'])
        ->paginate(10);

        /* dd($users); */

        return view('frontend.users', compact('users', 'request'));
    }

    /**
     * Method used to filter followers
     * @param request Request objects, contains keywords and locations if there are any
     */
    public function followers_filter(Request $request){

        // get array of followers ids
        $followers_ids = Follow::where('user_id',Auth::id())->select('follower_id')->get();

        $followers = User::
        whereIn('id', $followers_ids)
        // filter only verified users , instead it will throw error on slug/profile info/etc because it is set on 1st step..
        ->where('email_verified_at', '<>',null)
        // when there are keywords entered
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            // look for user with that username , no need for explode cause username is without spaces
            $query->where('username', 'like', '%'.$request->input('q').'%');
            // explode keywords
            $keywords = explode(' ', $request->input('q'));
            // for each keyword, check if it matches first name or last name
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('userProfile', function ($query) use ($keyword){
                        $query->select('*');
                        $query->where('username', 'like', '%'.$keyword.'%');
                        $query->orWhere('first_name', 'like', '%'.$keyword.'%');
                        $query->orWhere('last_name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        // when there is input in location field
        ->when($request->input('location'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
                //explode keywords
            $locations = explode(' ', $request->input('location'));
            // check if keyword matched city or country
                foreach ($locations as $location) {
                    $query->orWhereHas('userLocation', function ($query) use ($location){
                    $query->select('*');
                    $query->where('city', 'like', '%'.$location.'%');
                    $query->orWhere('country', 'like', '%'.$location.'%');
                });
                }
            });
        })
        ->with([
            'userProfile', 'userLocation', 'userSkills', 'followers'])
        ->paginate(10);

        /* dd($users); */

        return view('frontend.user_followers', compact('followers', 'request'));
    }


    /**
     * Method used to filter users that user is following
     * @param request Request objects, contains keywords and locations if there are any
     */
    public function following_filter(Request $request){

        // get array of following ids
        $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

        $following = User::
        whereIn('id', $following_ids)
        // filter only verified users , instead it will throw error on slug/profile info/etc because it is set on 1st step..
        ->where('email_verified_at', '<>',null)
        // when there are keywords entered
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            // look for user with that username , no need for explode cause username is without spaces
            $query->where('username', 'like', '%'.$request->input('q').'%');
            // explode keywords
            $keywords = explode(' ', $request->input('q'));
            // for each keyword, check if it matches first name or last name
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('userProfile', function ($query) use ($keyword){
                        $query->where('first_name', 'like', '%'.$keyword.'%');
                        $query->orWhere('last_name', 'like', '%'.$keyword.'%');
                    });
                }
            });
        })
        // when there is input in location field
        ->when($request->input('location'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
                //explode keywords
            $locations = explode(' ', $request->input('location'));
            // check if keyword matched city or country
                foreach ($locations as $location) {
                    $query->orWhereHas('userLocation', function ($query) use ($location){
                    $query->where('city', 'like', '%'.$location.'%');
                    $query->orWhere('country', 'like', '%'.$location.'%');
                });
                }
            });
        })
        ->with([
            'userProfile', 'userLocation', 'userSkills', 'followers'])
        ->paginate(10);

        /* dd($users); */

        return view('frontend.user_following', compact('following', 'request'));
    }





}
