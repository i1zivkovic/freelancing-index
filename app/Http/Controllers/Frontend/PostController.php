<?php

namespace App\Http\Controllers\Frontend;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostFile;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Validator;

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
        $following_ids = Follow::where('follower_id', Auth::id())->select('user_id')->get();

        // get the posts from those users
        $posts = Post::
            whereIn('user_id', $following_ids)
            ->withCount('post_comments', 'post_likes')
            ->with([
                'user',
            ])->orderBy('created_at', 'desc')->paginate(5);

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
        $posts = Post::withCount('post_comments', 'post_likes')
            ->with([
                'user',
            ])->orderBy('created_at', 'desc')->paginate(5);

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
     * @param  \Illuminate\Http\Request  $request object containing info and data about post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation rules
        $rules = [
            'title' => 'required|max:150|min:10',
            'description' => 'max:1000|min:50',
            'file' => 'required',
        ];

        // make validator
        $validator = Validator::make($request->all(), $rules);

        // check if validation success
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // create post
        $post = Post::create($request->except(['file']) + ['slug' => str_slug($request->title, '-') . time(), 'user_id' => Auth::id()]);

        // upload file if exists
        if (!empty($request->file('file'))) {
            $file = $this->uploadFile($request->file('file'), Auth::user()->username, $post->id);
            $post->post_files()->create(['path' => $file]);
        }

        // redirect to post
        return redirect()->to('posts/' . $post->slug);

    }

    /**
     * Display the specified post.
     *
     * @param  string  $slug Post slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // get the post from the slug
        $post = Post::
            where('slug', $slug)
            ->withCount('post_likes')
            ->with([
                'user',
                'post_comments' => function ($query) {
                    $query->join('users', 'post_comments.user_id', 'users.id');
                    $query->join('profiles', 'users.id', 'profiles.user_id');
                    $query->select('post_comments.*', 'users.username', 'users.slug', 'profiles.first_name', 'profiles.last_name')->orderBy('created_at', 'ASC');
                },
            ])->firstOrFail();

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
        // if there exists a post with given post id
        if (Post::where([['id', $id]])->exists()) {
            //get it
            $post = Post::findOrFail($id);

            // if the user that is making the request is not the owner
            if ($post->user_id != Auth::id()) {
                // show 403 error
                return abort(403);
            }
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
     * @param  int  $id id of the post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // if there exists post  with given id
        if (Post::where([['id', $id]])->exists()) {
            //get the post
            $post = Post::findOrFail($id);

            // if the user that is making the request is not the owner
            if ($post->user_id != Auth::id()) {
                // show 403 page
                return abort(403);
            }
            // else if the user is owner
            else {
                // Validation rules
                $rules = [
                    'title' => 'required|max:150|min:10',
                    'description' => 'max:1000|min:50',
                    'file' => 'required',
                ];

                // make validator
                $validator = Validator::make($request->all(), $rules);

                // check if validation success
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                // update all field except file
                $post->update($request->except(['file']) + ['slug' => str_slug($request->title, '-') . time()]);

                // if file is uploaded
                if (!empty($request->file('file'))) {
                    // and there is already url in database for that post
                    if (!empty($post->post_files)) {
                        // get the path
                        $fileCheck = public_path() . '/uploads/' . Auth::user()->username . '/posts/' . $post->id . '/' . $post->post_files->path;
                        if (file_exists($fileCheck)) {
                            //delete folder
                            File::deleteDirectory(public_path() . '/uploads/' . Auth::user()->username . '/posts/' . $post->id);
                        }
                    }
                    //create new file and folder
                    $file = $this->uploadFile($request->file('file'), Auth::user()->username, $post->id);
                    // update or create post_file relation
                    $post->post_files()->updateOrCreate([], ['path' => $file]);
                }

                //redirect back to post
                return redirect()->to('posts/' . $post->slug)->with('edit_success', 'You have successfully edited your post.');
            }

        }
        // if there is no post with given id
        else {
            // return 404 page
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

        // if there exists a post with given  post id
        if (Post::where([['id', $id]])->exists()) {
            // get the post
            $post = Post::findOrFail($id);

            // if the user that is making the request is not the owner
            if ($post->user_id != Auth::id()) {
                // show 403 error
                $return = array(
                    'error' => 'You are not allowed to execute this action!',
                );
                return response()->json($return, 400);
            }

            // get the post file id
            $post_file_id = PostFile::where('post_id', $id)->select('id')->firstOrFail();

            // if there is file
            if ($post_file_id) {
                // get the path
                $filePath = public_path() . '/uploads/' . Auth::user()->username . '/posts/' . $post->id . '/' . $post->post_files->path;

                // check for file  and delete folder/file if exists
                if (file_exists($filePath)) {
                    //delete folder
                    File::deleteDirectory(public_path() . '/uploads/' . Auth::user()->username . '/posts/' . $post->id);
                }
            }

            // Delete post and all othere data will be deleted too that has relation
            $post->delete();

            //return ok
            $return = array(
                'success' => 'You have successfully deleted this post!',
            );
            return response()->json($return, 200);
        }
        //else return error
        else {
            $return = array(
                'error' => 'This post does not exist in database!',
            );
            return response()->json($return, 400);
        }
    }

    /**
     * Get all posts (paginate) for specified user )slug).
     *
     * @param  string  $slug Logged in user slug
     * @return \Illuminate\Http\Response
     */
    public function getMyPosts($slug)
    {
        // get the posts
        $posts = Post::
            where('user_id', Auth::id())
            ->withCount('post_comments', 'post_likes')
            ->with([
                'user',
            ])->orderBy('updated_at', 'DESC')->paginate(5);

        //return view with data
        return view('frontend.user_posts', compact('posts'));

    }

    /**
     * Filter for user feed posts
     * @param Request $request Request object containing data about filter
     */
    public function postPostFilter(Request $request)
    {

        //get the array of the users that currently logged in user is following
        $following_ids = Follow::where('follower_id', Auth::id())->select('user_id')->get();

        // get filtered posts from those users
        $posts = Post::whereIn('user_id', $following_ids)
            ->when($request->input('q'), function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->input('q') . '%');
                });
            })
            ->when($request->input('user'), function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $user_data = explode(' ', $request->input('user'));
                    foreach ($user_data as $user_d) {
                        $query->orWhereHas('user.userProfile', function ($query) use ($user_d) {
                            $query->select('*');
                            $query->where('username', 'like', '%' . $user_d . '%');
                            $query->orWhere('first_name', 'like', '%' . $user_d . '%');
                            $query->orWhere('last_name', 'like', '%' . $user_d . '%');
                        });
                    }
                });
            })
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'username');
                }])
            ->withCount(['post_likes', 'post_comments'])
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // return view
        return view('frontend.posts', compact('posts', 'request'));
    }

    /**
     * Filter for posts (explore()
     * @param Request $request Request object containing data about filter
     */
    public function postPostExploreFilter(Request $request)
    {

        $posts = Post::when($request->input('q'), function ($query) use ($request) {
            return $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('q') . '%');
            });
        })
            ->when($request->input('user'), function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $user_data = explode(' ', $request->input('user'));
                    foreach ($user_data as $user_d) {
                        $query->orWhereHas('user.userProfile', function ($query) use ($user_d) {
                            $query->select('*');
                            $query->where('username', 'like', '%' . $user_d . '%');
                            $query->orWhere('first_name', 'like', '%' . $user_d . '%');
                            $query->orWhere('last_name', 'like', '%' . $user_d . '%');
                        });
                    }
                });
            })
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'username');
                }])
            ->withCount(['post_likes', 'post_comments'])
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('frontend.explore', compact('posts', 'request'));
    }

    /**
     * Filter for my posts
     * @param Request $request Request object containing info about filters
     */
    public function postMyPostFilter(Request $request)
    {
        $posts = Post::
            where('user_id', Auth::id())
            ->when($request->input('q'), function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->input('q') . '%');
                });
            })
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'username');
                }])
            ->withCount(['post_likes', 'post_comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('frontend.user_posts', compact('posts', 'request'));
    }

    /**
     * Method used to upload files
     * @param $file file
     * @param $username username of the logged in user
     * @param $post_id Id of the post
     */
    public function uploadFile($file, $username, $post_id)
    {

        // if folder does not exists, create one with all persmissions
        if (!is_dir(public_path() . '/uploads/' . $username . '/posts/' . $post_id)) {
            mkdir(public_path() . '/uploads/' . $username . '/posts/' . $post_id, 0777, true);
        }

        // get the destination path
        $destinationPath = public_path() . '/uploads/' . $username . '/posts/' . $post_id . '/';

        // get the file name and create new one with timestamp
        $file_name = time() . '-' . $file->getClientOriginalName();

        // move files / create file in $folder
        $file->move($destinationPath, $file_name);

        // return file
        return $file_name;
    }

}
