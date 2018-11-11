<?php

use Illuminate\Database\Seeder;
use App\UserRating;

class UserRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 2,
            'job_id' => 1,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 3,
            'job_id' => 1,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 4,
            'job_id' => 1,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 2,
            'job_id' => 2,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 3,
            'job_id' => 2,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
         UserRating::create([
            'recruiter_id' => 1,
            'freelancer_id' => 4,
            'job_id' => 2,
            'comment' => 'Very nicely done.',
            'rating' => 5
        ]);
    }
}
