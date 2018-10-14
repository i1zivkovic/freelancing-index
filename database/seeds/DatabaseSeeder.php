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
    }
}
