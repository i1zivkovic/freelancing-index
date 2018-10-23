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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            'job_id' => 'required|exists:jobs,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /* dd($request); */
        $comment = new JobComment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->job_id = $request->job_id;

        $comment->save();

        return redirect()->to('jobs/'.$request->job_slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if( JobComment::where([['user_id', $userId], ['id', $id]])->exists() )
        {
        JobComment::findOrFail($id)->delete();
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
}
