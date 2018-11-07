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
     * Display a listing of the resource.
     * User feed
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

        $posts = Post::
        whereIn('user_id', $following_ids)
        ->withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);


        return view('frontend.posts', compact('posts'));
    }

      /**
     * Display a listing of the resource.
     *  Explore
     * @return \Illuminate\Http\Response
     */
    public function explore()
    {

        $posts = Post::withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);


        return view('frontend.explore', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.post_create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

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

        return view('frontend.post_details', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( Post::where([['user_id', Auth::id()], ['id', $id]])->exists())
        {

         $post = Post::where('id',$id)->firstOrFail();
         return view('frontend.post_edit', compact('post'));

        }
         else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $userId = Auth::id();

        if( Post::where([['user_id', $userId], ['id', $id]])->exists() )
        {

            // Delete post
        Post::findOrFail($id)->delete();
            // Delete comments
        PostComment::where('post_id', $id)->delete();
            // Delete likes
        PostLike::where('post_id',$id)->delete();
        $return = array(
            'success' => 'You have successfully deleted this post!'
        );
        return response()->json($return, 200);
        }
        else {
            $return = array(
                'error' => 'This post does not exist in database!'
            );
            return response()->json($return, 400);
        }
    }



    /**
     * Get all posts for specified user id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyPosts($slug)
    {


        $postCount = Post::
        where('user_id', Auth::id())
        ->count();

        $posts = Post::
        where('user_id', Auth::id())
        ->withCount('post_comments','post_likes')
        ->with([
            'user',
        ]) -> paginate(5);

        return view('frontend.user_posts', compact('posts','postCount'));


    }

    /**
     * Filter for user feed posts
     */
    public function postPostFilter(Request $request){

        $following_ids = Follow::where('follower_id',Auth::id())->select('user_id')->get();

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
/*
        dd($posts); */

        return view('frontend.posts', compact('posts', 'request'));
    }

    /**
     * Filter for posts (explore()
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
/*
        dd($posts); */

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
