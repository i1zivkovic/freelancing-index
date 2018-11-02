<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;

use App\JobLike;
use Illuminate\Http\Request;

class JobLikeController extends Controller
{
    public function likeUnlikeHandler(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'Like':

            // if there is a record that user already liked the job
            if( JobLike::where([['user_id', Auth::id()], ['job_id', $id]])->exists() ) {
                $return = array(
                    'error' => 'You have already liked this job!'
                );
                return response()->json($return, 400);
            }
            // if there is no record
            else {
                $jobLike = new JobLike;
                $jobLike->user_id = Auth::id();
                $jobLike->job_id = (int)$id;
                $jobLike->save();
                $return = array(
                    'success' => 'You have successfully liked this job!'
                );
                return response()->json($return, 200);
                break;
            }


            //  CASE UNLIKE
            case 'Unlike':
            // if there exists like with specific user id and job id
            if( JobLike::where([['user_id', Auth::id()], ['job_id', $id]])->exists() ) {
                // delete
                JobLike::where([['job_id', $id],['user_id',Auth::id()]])->delete();
                $return = array(
                    'success' => 'You have successfully unliked this job!'
                );
                return response()->json($return, 200);
                break;
                }
                // throw error
                else
                 {
                    $return = array(
                        'error' => 'This like does not exist in database!'
                    );
                    return response()->json($return, 400);
                }
        }
    }


}
