<?php

use Illuminate\Database\Seeder;
use App\JobLike;
class JobLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobLike::create([
            'user_id' => 1,
            'job_id' => 1
        ]);
        JobLike::create([
            'user_id' => 1,
            'job_id' => 2
        ]);
        JobLike::create([
            'user_id' => 1,
            'job_id' => 6
        ]);
    }
}
