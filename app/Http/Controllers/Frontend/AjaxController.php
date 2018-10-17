<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\PostComment;

class AjaxController extends Controller
{
    /**
     * @param Request $request
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

}
