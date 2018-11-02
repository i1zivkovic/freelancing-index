<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesSeeder::class);
        $this->call(SkillsSeeder::class);
        $this->call(BusinessCategoriesSeeder::class);
        $this->call(JobApplicationStateSeeder::class);
        $this->call(JobStatusesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ProfileEducationSeeder::class);
        $this->call(ProfileExperienceSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(JobSkillSeeder::class);
        $this->call(JobLikesSeeder::class);
        $this->call(JobCommentsSeeder::class);
        $this->call(JobApplicationSeeder::class);
        $this->call(PostLikesSeeder::class);
        $this->call(PostCommentsSeeder::class);
    }
}
