<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;

use App\Post;
use App\PostComment;
use App\PostLike;
use App\User;
use App\Follow;
use Illuminate\Http\Request;

class PostController extends Controller
{

      /**
     * Display a listing of the posts.
     * User feed
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the array of ids from a users that a logged in user is following
        $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

        // get the posts from those users
        $posts = Post::
        whereIn('user_id', $following_ids)
        ->withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);

        // return view with posts
        return view('frontend.posts', compact('posts'));
    }

      /**
     * Display a explore posts.
     *  Explore
     * @return \Illuminate\Http\Response
     */
    public function explore()
    {
        // get all posts with pagination
        $posts = Post::withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);

        // return view
        return view('frontend.explore', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.post_create');
    }

    /**
     * Store a newly created post in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*
        dd($request); */

       /*  $rules = [
            'title' => 'required|max:1000',
            'post_id' => 'required|exists:posts,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } */

        /* dd($request); */
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->description = $request->description;
        $post->slug = str_slug($request->title, '-').time();

        $post->save();

        return redirect()->to('posts/'.$post->slug);

    }

    /**
     * Display the specified post.
     *
     * @param  int  $slug Post slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // get the post from the slug
        $post = Post::
        where('slug',$slug)
        ->withCount('post_likes')
        ->with([
            'user',
            'post_comments' => function($query) {
                $query -> join('users', 'post_comments.user_id', 'users.id');
                $query -> join('profiles', 'users.id', 'profiles.user_id');
                $query -> select('post_comments.*', 'users.username', 'users.slug', 'profiles.first_name', 'profiles.last_name')->orderBy('created_at','ASC');
            }
        ]) -> firstOrFail();

        // return view with data
        return view('frontend.post_details', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id id of the post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if there exists a post with given user id and post id
        if( Post::where([['user_id', Auth::id()], ['id', $id]])->exists())
        {
            //get it
         $post = Post::where('id',$id)->firstOrFail();
         //return view
         return view('frontend.post_edit', compact('post'));

        }
        //else redirect to 404 page
         else {
            return abort(404);
        }
    }

    /**
     * Update the specified post in database.
     *
     * @param  \Illuminate\Http\Request  $request object containing info about the new post data
     * @param  int  $id id of the job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /*  $rules = [
             'title' => 'required|max:1000',
             'post_id' => 'required|exists:posts,id',
         ];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         } */

         /* dd($request); */


         if( Post::where([['user_id', Auth::id()], ['id', $id]])->exists())
         {

         $post = Post::find($id);
         $post->title = $request->title;
         $post->description = $request->description;
         $post->slug = str_slug($request->title, '-').time();

         $post->save();


         return redirect()->to('posts/'.$post->slug);
         }
         else {
             return abort(404);
         }

    }

    /**
     * Remove the specified post from database.
     *
     * @param  int  $id Id of the post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the logged in user id
        $userId = Auth::id();

        // if there exists a post with given user id and post id
        if( Post::where([['user_id', $userId], ['id', $id]])->exists() )
        {

            // Delete post and all othere data will be deleted too that has relation
        Post::findOrFail($id)->delete();

        //return ok
        $return = array(
            'success' => 'You have successfully deleted this post!'
        );
        return response()->json($return, 200);
        }
        //else return error
        else {
            $return = array(
                'error' => 'This post does not exist in database!'
            );
            return response()->json($return, 400);
        }
    }



    /**
     * Get all posts for specified user slug.
     *
     * @param  int  $slug Logged in user slug
     * @return \Illuminate\Http\Response
     */
    public function getMyPosts($slug)
    {
        // get the posts
        $posts = Post::
        where('user_id', Auth::id())
        ->withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> paginate(5);

        //return view with data
        return view('frontend.user_posts', compact('posts'));


    }

    /**
     * Filter for user feed posts
     * @param Request $request Request object containing data about filter
     */
    public function postPostFilter(Request $request){

        //get the array of the users that currently logged in user is following
        $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

        // get filtered posts from those users
        $posts = Post::whereIn('user_id', $following_ids)
        ->when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
            });
        })
        ->when($request->input('username'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {

            $username =  $request->input('username');
            $user = User::where('username', '=', $username)->first();
                    $query->orWhere('user_id', '=', $user->id);
            });
        })
        ->with([
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['post_likes', 'post_comments'])
        ->with('user')
        ->orderBy('created_at','desc')
        ->paginate(5);

        // return view
        return view('frontend.posts', compact('posts', 'request'));
    }

    /**
     * Filter for posts (explore()
     * @param Request $request Request object containing data about filter
     */
    public function postPostExploreFilter(Request $request){

        $posts = Post::when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
            });
        })
        ->when($request->input('username'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {

            $username =  $request->input('username');
            $user = User::where('username', '=', $username)->first();
                    $query->orWhere('user_id', '=', $user->id);
            });
        })
        ->with([
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['post_likes', 'post_comments'])
        ->with('user')
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('frontend.explore', compact('posts', 'request'));
    }


    /**
     * Filter for my posts
     */
    public function postMyPostFilter(Request $request){
        $posts = Post::
        where('user_id', Auth::id())
       -> when($request->input('q'), function($query) use ($request) {
            return $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
            });
        })
        ->with([
        'user' => function($query){
            $query->select('id', 'username');
        }])
        ->withCount(['post_likes', 'post_comments'])
        ->orderBy('created_at','desc')
        ->paginate(5);
/*
        dd($posts); */

        return view('frontend.user_posts', compact('posts', 'request'));
    }


}
