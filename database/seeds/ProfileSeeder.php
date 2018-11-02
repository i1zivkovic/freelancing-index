<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Profile::create([
            'user_id' => 1,
            'gender' => 'm',
            'date_of_birth' => '1996-01-16',
             'about_me' => 'My name is Ivan1. I"m a student at the Faculty of Electrical Engineering, Computer Science and Information Tehcnology',
             'website_url' => 'i1zivkovic.com',
             'first_name' => 'Ivan1',
             'last_name' => 'Zivkovic',
              'contact_number' => '0993403646'
        ]);
        //
        Profile::create([
            'user_id' => 2,
            'gender' => 'm',
            'date_of_birth' => '1996-01-16',
             'about_me' => 'My name is Ivan2. I"m a student at the Faculty of Electrical Engineering, Computer Science and Information Tehcnology',
             'website_url' => 'i2zivkovic.com',
             'first_name' => 'Ivan2',
             'last_name' => 'Zivkovic',
              'contact_number' => '0993403646'
        ]);
        //
        Profile::create([
            'user_id' => 3,
            'gender' => 'm',
            'date_of_birth' => '1996-01-16',
             'about_me' => 'My name is Ivan3. I"m a student at the Faculty of Electrical Engineering, Computer Science and Information Tehcnology',
             'website_url' => 'i3zivkovic.com',
             'first_name' => 'Ivan3',
             'last_name' => 'Zivkovic',
              'contact_number' => '0993403646'
        ]);
        //
        Profile::create([
            'user_id' => 4,
            'gender' => 'm',
            'date_of_birth' => '1996-01-16',
             'about_me' => 'My name is Ivan4. I"m a student at the Faculty of Electrical Engineering, Computer Science and Information Tehcnology',
             'website_url' => 'i4zivkovic.com',
             'first_name' => 'Ivan4',
             'last_name' => 'Zivkovic',
              'contact_number' => '0993403646'
        ]);
    }
}
