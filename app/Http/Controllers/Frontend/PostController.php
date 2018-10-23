<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;

use App\Post;
use App\PostComment;
use App\PostLike;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::
        withCount('postComments','postLikes')
        ->with([
            'user',
        ]) -> orderBy('created_at','desc') -> paginate(5);

        $recentPosts = Post::with([
            'user' => function($query){
                $query->select('id','username', 'slug');
            }
        ])->orderBy('created_at','DESC')->take(3)->select('id','title','created_at','user_id','slug')->get();

        return view('frontend.posts', compact('posts','recentPosts'));
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
        ->withCount('postLikes')
        ->with([
            'user',
            'postComments' => function($query) {
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

        $post = Post::where('id',$id)->firstOrFail();

        return view('frontend.post_edit', compact('post'));
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
         $post = Post::find($id);
         $post->title = $request->title;
         $post->description = $request->description;
         $post->slug = str_slug($request->title, '-').time();

         $post->save();


         return redirect()->to('posts/'.$post->slug);

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
        return [
        'status' => 1
        ];
        }
        else {
            return [
                'status' => 0,
                'bla' => 1
            ];
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
        ->withCount('postComments','postLikes')
        ->with([
            'user',
        ]) -> paginate(5);

        return view('frontend.user_posts', compact('posts','postCount'));


    }


}
