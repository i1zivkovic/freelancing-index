<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Job;

class DeleteUnavailableJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletejobs:unavailable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unavailable jobs after 15 days in that state.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //


    }
}
