<?php

use Illuminate\Database\Seeder;
use App\JobApplicationState;

class JobApplicationStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        JobApplicationState::create([
            'state' => 'Waiting'
        ]);
        //
        JobApplicationState::create([
            'state' => 'Accepted'
        ]);
        //
        JobApplicationState::create([
            'state' => 'Rejected'
        ]);
    }
}
