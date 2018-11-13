<?php

use Illuminate\Database\Seeder;
use App\JobStatus;

class JobStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Active for applications
        JobStatus::create([
            'name' => 'Active',
        ]);
          // Job is done
          JobStatus::create([
            'name' => 'Done',
        ]); // Job is temporarily canceled
          JobStatus::create([
            'name' => 'Unavailable',
        ]);
        // job is in process
          JobStatus::create([
            'name' => 'In process',
        ]);
    }
}
