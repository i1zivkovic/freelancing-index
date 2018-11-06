<?php

use Illuminate\Database\Seeder;
use App\ProfileExperience;

class ProfileExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProfileExperience::create([
            'start_date' => '2017-01-09',
            'end_date' => '2017-02-27',
            'job_title' => 'Front-end developer',
            'job_description' => 'I was working on a project that converted .xsd files into graphical user interface. I used Java for parsing .xsd file into HTML and Javascript/AngularJs. GUI was done using Boostrap, AngularJs and HTML.',
            'company_name' => 'Siemens Convergence Creators',
            'job_location_city' => 'Osijek',
            'job_location_country' => 'Croatia',
            'profile_id' => 1
        ]);
        ProfileExperience::create([
            'start_date' => '2010-09-19',
            'end_date' => '2017-02-27',
            'job_title' => 'Front-end developer',
            'job_description' => 'I was working on 2 projects. First one was about data analysis and company surveys. The other one was about VOMS system. I was doing front-end developing using Angular5 mostyle as JS framework, MaterializeCSS, HTML and so on. Now I"m working on number portabilty system, e.g. building GUI.',
            'company_name' => 'Atos Convergece Creators',
            'job_location_city' => 'Osijek',
            'job_location_country' => 'Croatia',
            'profile_id' => 1
        ]);
    }
}
