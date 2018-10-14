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
        //
        JobStatus::create([
            'name' => 'Active',
        ]);
          //
          JobStatus::create([
            'name' => 'Done',
        ]);
        JobStatus::create([
            'name' => 'Reserved',
        ]);
          //
          JobStatus::create([
            'name' => 'In Progress',
        ]);
          JobStatus::create([
            'name' => 'Canceled',
        ]);
    }
}
