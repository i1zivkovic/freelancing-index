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
        $this->call(JobStatusesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ProfileEducationSeeder::class);
        $this->call(ProfileExperienceSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(JobSeeder::class);
<<<<<<< HEAD
        /*$this->call(PostLikesSeeder::class);
        $this->call(PostCommentsSeeder::class); */
=======
        $this->call(JobSkillSeeder::class);
        /* $this->call(PostLikesSeeder::class);
        $this->call(PostCommentsSeeder::class);  */
>>>>>>> 612c8c3992c5e0169494e804f7ac30b92e44c50a


    }
}
