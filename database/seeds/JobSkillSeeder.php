<?php

use Illuminate\Database\Seeder;
use App\JobSkill;

class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        JobSkill::create([
            'job_id' => 1,
            'skill_id' => 1,
        ]);
          //
          JobSkill::create([
            'job_id' => 1,
            'skill_id' => 2,
        ]);
          JobSkill::create([
            'job_id' => 1,
            'skill_id' => 3,
        ]);
          JobSkill::create([
            'job_id' => 1,
            'skill_id' => 4,
        ]);
          JobSkill::create([
            'job_id' => 1,
            'skill_id' => 5,
        ]);
          JobSkill::create([
            'job_id' => 1,
            'skill_id' => 6,
        ]);
        JobSkill::create([
            'job_id' => 2,
            'skill_id' => 1,
        ]);
          //
          JobSkill::create([
            'job_id' => 2,
            'skill_id' => 2,
        ]);
          JobSkill::create([
            'job_id' => 2,
            'skill_id' => 3,
        ]);
          JobSkill::create([
            'job_id' => 2,
            'skill_id' => 4,
        ]);
          JobSkill::create([
            'job_id' => 2,
            'skill_id' => 5,
        ]);
          JobSkill::create([
            'job_id' => 2,
            'skill_id' => 6,
        ]);
    }
}
