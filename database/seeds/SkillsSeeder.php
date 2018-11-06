<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Skill::create([
            'name' => 'Design',
        ]);
          Skill::create([
            'name' => 'AngularJS',
        ]);
          Skill::create([
            'name' => 'Wordpress',
        ]);
          Skill::create([
            'name' => 'PHP',
        ]);
          Skill::create([
            'name' => 'Laravel',
        ]);
          Skill::create([
            'name' => 'HTML5',
        ]);
          Skill::create([
            'name' => 'CSS3',
        ]);
          Skill::create([
            'name' => 'Illustrator',
        ]);
          Skill::create([
            'name' => 'Adobe Photoshop',
        ]);
    }
}
