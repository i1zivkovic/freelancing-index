<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;

use App\Post;

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
        ]) -> paginate(5);

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
        //
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

    }


}
