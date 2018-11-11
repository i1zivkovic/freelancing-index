<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\PostComment;
use App\JobFile;
use App\Job;
use File;
use Auth;

class AjaxController extends Controller
{
    /**
     * Method used for select 2 autocomplete (skills)
     * @param Request $request contains info about searched skills
     * @return \Illuminate\Http\JsonResponse
     */
    public function findSkill(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $skills = Skill::where('name', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_skills = [];

        foreach ($skills as $skill) {
            $formatted_skills[] = ['id' => $skill->id, 'text' => $skill->name];
        }

        return \Response::json($formatted_skills);
    }


    /**
     * Method used to delete file from job
     * @param $request request object
     */
    public function deleteJobFile(Request $request) {


        // id of the file
        $file_id = $request['file_id'];

        $job_file = JobFile::findOrFail($file_id);

        $job = Job::findOrFail($job_file->job_id);

        // check if file exists
        if ($job_file->exists()) {

            // if file exists but the user is not thw owner of the job
            if($job->user_id != Auth::id()) {
                $return = array(
                    'error' => 'You are not allowed to execute this action!'
                );
                return response()->json($return, 403);
            }

            //delete file
            unlink(public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job_file->job_id.'/'.$job_file->path);
            //delete folder
            File::deleteDirectory(public_path().'/uploads/'.Auth::user()->username.'/jobs/'.$job_file->job_id);
            // delete from DB
            $job_file->delete();
            $return = array(
                'success' => 'You have successfully deleted this file!'
            );
            return response()->json($return, 200);
        }else {
            $return = array(
                'error' => 'Error deleting while file!'
            );
            return response()->json($return, 404);
        }
    }
}
