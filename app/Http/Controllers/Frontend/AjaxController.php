<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\PostComment;
use App\JobFile;
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
     * @param id id of the file 
     */
    public function deleteJobFile($id) {

        $job_file = JobFile::findOrFail($id);
        if ($job_file->exists()) {
            unlink(public_path().'/uploads/'.Auth::user()->username.'/'.$job_file->path);
            $job_file->delete();
            return [
                'status' => 1
            ];
        }else {
            return [
                'status' => 0
            ];
        }
    }
}
