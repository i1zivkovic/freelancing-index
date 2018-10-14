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
            'name' => 'designer',
        ]);
          Skill::create([
            'name' => 'anuglarjs',
        ]);
          Skill::create([
            'name' => 'wordpress',
        ]);
          Skill::create([
            'name' => 'php',
        ]);
          Skill::create([
            'name' => 'laravel',
        ]);
          Skill::create([
            'name' => 'nodejs',
        ]);
    }
}
