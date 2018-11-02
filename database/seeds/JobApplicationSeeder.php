<?php

use Illuminate\Database\Seeder;
use App\JobApplication;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        JobApplication::create([
            'job_id' => 1,
            'user_id' => 2,
            'comment' =>  'This is a test application comment.',
            'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 1,
            'user_id' => 3,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 1,
            'user_id' => 4,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 2,
            'user_id' => 2,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 2,
        ]);
        JobApplication::create([
            'job_id' => 2,
            'user_id' => 3,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 3,
        ]);
        JobApplication::create([
            'job_id' => 2,
            'user_id' => 4,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 3,
            'user_id' => 2,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 4,
            'user_id' => 2,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
        JobApplication::create([
            'job_id' => 4,
            'user_id' => 3,
             'comment' =>  'This is a test application comment.',
             'job_application_state_id' => 1,
        ]);
    }
}
