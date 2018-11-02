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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'comment' => 'required|max:1000',
            'post_id' => 'required|exists:posts,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /* dd($request); */
        $comment = new PostComment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;

        $comment->save();

        return redirect()->to('posts/'.$request->post_slug);
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

        $userId = Auth::id();

        if( PostComment::where([['user_id', $userId], ['id', $id]])->exists() )
        {
        PostComment::findOrFail($id)->delete();
        $return = array(
            'success' => 'Comment has been successfully deleted!'
        );
        return response()->json($return, 200);
        }
        else {
            $return = array(
                'error' => 'This comment does not exist in database!'
            );
            return response()->json($return, 400);
        }


    }
}
