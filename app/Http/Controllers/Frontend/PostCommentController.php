<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;
use App\PostComment;
use Validator;

use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    /**
     * Store a newly created comment in database.
     *
     * @param  \Illuminate\Http\Request  $request object containing info about the comment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //set rulesw
        $rules = [
            'comment' => 'required|max:1000',
            'post_id' => 'required|exists:posts,id',
        ];
        //create validator
        $validator = Validator::make($request->all(), $rules);
        //check for erros
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // if there are no errors, create comment
        PostComment::create($request->all());

        //return to the job
        return redirect()->to('posts/'.$request->post_slug);
    }

    /**
     * Update the specified post comment in database.
     *
     * @param  \Illuminate\Http\Request  $request object containing info about the comment
     * @param  int  $id Id of the post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // check the length of comment first so it doesn't query database if it is valid
        if(!(strlen($request->get('comment')) > 1000)) {
            // if there exists comment that the logged in user has posted with given id
            if(PostComment::where([['user_id', Auth::id()], ['id', $id]])->exists()) {
                // get the comment and update the 'comment' property
                $comment = PostComment::where([['id', $id], ['user_id', Auth::id()]])->firstOrFail();
                $comment->update(['comment' => $request->get('comment')]);
                // return OK response
                $return = array(
                    'success' => 'Your comment has been successfully updated!'
                );
                return response()->json($return, 200);
            }
            // if there is no comment with given id that the logged in user posted
            else
            {
                // return error
                $return = array(
                    'error' => 'This comment does not exist in database!'
                );
                return response()->json($return, 400);
            }
        }
        // if the comment is too long
        else {
            // return error
            $return = array(
                'error' => 'Your comment is too long! Maximum is 1000 characters and your has '.strlen($request->get('comment'))
            );
            return response()->json($return, 400);
        }
    }

    /**
     * Remove the specified post comment from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get logged in user id
        $userId = Auth::id();

        // if there exists comment with given user_id and post id
        if( PostComment::where([['user_id', $userId], ['id', $id]])->exists() )
        {
        //delete it
        PostComment::findOrFail($id)->delete();
        //return OK
        $return = array(
            'success' => 'Comment has been successfully deleted!'
        );
        return response()->json($return, 200);
        }
        //else return error
        else {
            $return = array(
                'error' => 'This comment does not exist in database!'
            );
            return response()->json($return, 400);
        }


    }
}
