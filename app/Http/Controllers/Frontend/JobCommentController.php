<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;
use App\JobComment;
use Validator;

use Illuminate\Http\Request;

class JobCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // set rules and check them
        $rules = [
            'comment' => 'required|max:1000',
            'job_id' => 'required|exists:jobs,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // if rules are asserted, create new comment
        $comment = new JobComment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->job_id = $request->job_id;

        $comment->save();

        return redirect()->to('jobs/'.$request->job_slug);
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
        // check the length of comment first so it doesn't query database if it is valid
        if(!(strlen($request->get('comment')) > 1000)) {
            // if there exists comment that the logged in user has posted with given id
            if(JobComment::where([['user_id', Auth::id()], ['id', $id]])->exists()) {
                // get the comment and update the 'comment' property
                $comment = JobComment::where([['id', $id], ['user_id', Auth::id()]])->firstOrFail();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        // if there is job comment that matches these conditionals
        if( JobComment::where([['user_id', $userId], ['id', $id]])->exists() )
        {
            //dete job comment
            JobComment::findOrFail($id)->delete();
             $return = array(
                        'success' => 'Comment has been successfully deleted!'
                    );
             return response()->json($return, 200);
        }
        // else throw error
        else {
            $return = array(
                'error' => 'This comment does not exist in database!'
            );
            return response()->json($return, 400);
        }


    }
}
