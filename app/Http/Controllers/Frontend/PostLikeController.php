<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Auth;

use App\PostLike;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
     /**
     * Method used to handle likes/unlikes
     * @param $id Id of the post
     * @param $request contains info about the action (like, unlike)
     */
    public function likeUnlikeHandler(Request $request, $id)
    {
        $action = $request->get('action');

        switch ($action) {
            // CASE LIKE
            case 'Like':

            // if there is a record that user already liked the job
            if( PostLike::where([['user_id', Auth::id()], ['post_id', $id]])->exists() ) {
                $return = array(
                    'error' => 'You have already liked this post!'
                );
                return response()->json($return, 400);
            }
            // if there is no record
            else {
                $postLike = new PostLike;
                $postLike->user_id = Auth::id();
                $postLike->post_id = (int)$id;
                $postLike->save();
                $return = array(
                    'success' => 'You have successfully liked this post!'
                );
                return response()->json($return, 200);
                break;
            }


            //  CASE UNLIKE
            case 'Unlike':
            // if there exists like with specific user id and job id
            if( PostLike::where([['user_id', Auth::id()], ['post_id', $id]])->exists() ) {
                // delete
                PostLike::where([['post_id', $id],['user_id',Auth::id()]])->delete();
                $return = array(
                    'success' => 'You have successfully unliked this post!'
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
