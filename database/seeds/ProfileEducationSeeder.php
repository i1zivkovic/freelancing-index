<?php

use Illuminate\Database\Seeder;
use App\ProfileEducation;

class ProfileEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfileEducation::create([
            'institution_name' => 'Tehnička škola Ruđera Boškovića, Vinkovci',
            'major' => 'Mechatronics',
            'start_date' => '2010-12-31',
            'end_date' => '2010-12-31',
            'description' => 'Test description',
            'degree' => 'Technician for mechatronics',
            'profile_id' => 1
        ]);
        ProfileEducation::create([
            'institution_name' => 'Faculty of computing, computer science and information technology, Osijek',
            'major' => 'Computer Science',
            'start_date' => '2014-12-31',
            'end_date' => '2018-12-31',
            'description' => 'Faks',
            'degree' => 'Bachelor of information technology',
            'profile_id' => 1
        ]);
    }
}
