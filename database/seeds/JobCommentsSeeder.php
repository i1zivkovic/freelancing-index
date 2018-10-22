<?php

use Illuminate\Database\Seeder;
use App\JobComment;
class JobCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i < 25; $i++){
            JobComment::create([
                'user_id' => 1,
                'job_id' => rand(1,6),
                'comment' => 'Ovo je komentar broj '.$i
            ]);
        }
    }
}
