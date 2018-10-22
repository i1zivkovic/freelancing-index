<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for graphic designer to some responsive website design.',
            'description' => 'Hi. My name is Ivan and I"m looking for a graphic designer to design me a website. The website is about a job portal. For more info contact me through e-mail.',
            'slug' => 'looking-for-graphic-designer-to-some-responsive-website-design-1234313335',
            'offer' => '20€',
            'is_per_hour' => 1,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for a front-end developer to code me a website functionality using Angular 5',
            'description' => 'Hi. My name is Ivan and I"m looking for a front-end developer to reuse existing backend to create functionality on a website.',
            'slug' => 'looking-for-a-front-end-developer-to-code-me-a-website-functionality-using-angular-5-1234313335',
            'offer' => '30€',
            'is_per_hour' => 1,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for a front-end developer to recreate a PS design into responsive website.',
            'description' => 'Hi. My name is Ivan and I"m looking for a graphic designer to design me a website. The website is about a job portal. For more info contact me through e-mail.',
            'slug' => 'looking-for-a-front-end-developer-to-recreate-a-ps-design-into-responsive-website-1234313335.',
            'offer' => '200€',
            'is_per_hour' => 0,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for a front-end developer to recreate a PSD design into responsive website.',
            'description' => 'Hi. My name is Ivan and I"m looking for a graphic designer to design me a website. The website is about a job portal. For more info contact me through e-mail.',
            'slug' => 'looking-for-a-front-end-developer-to-recreate-a-ps-design-into-responsive-website-1234313335.',
            'offer' => '200€',
            'is_per_hour' => 0,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for a front-end developer to blabla a PS design into responsive website.',
            'description' => 'Hi. My name is Ivan and I"m looking for a graphic designer to design me a website. The website is about a job portal. For more info contact me through e-mail.',
            'slug' => 'looking-for-a-front-end-developer-to-recreate-a-ps-design-into-responsive-website-1234313335.',
            'offer' => '200€',
            'is_per_hour' => 0,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
        $job = Job::create([
            'user_id' => 1,
            'title' => 'Looking for a backe-end developer to blabla a PS design into responsive website.',
            'description' => 'Hi. My name is Ivan and I"m looking for a graphic designer to design me a website. The website is about a job portal. For more info contact me through e-mail.',
            'slug' => 'looking-for-a-front-end-developer-to-recreate-a-ps-design-into-responsive-website-1234313335.',
            'offer' => '200€',
            'is_per_hour' => 0,
            'is_remote' => 1,
            'job_status_id' => 1,
            'job_location_zip' => 32100,
            'job_location_city' => 'Vinkovci',
            'job_location_state' => 'Vukovarsko-Srijemska',
            'job_location_street' => 'Matije Ivanića 9',
            'job_location_country' =>  'Croatia'
        ]);
    }
}
