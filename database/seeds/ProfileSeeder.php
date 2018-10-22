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
             'about_me' => 'My name is Ivan. I"m a student at the Faculty of Electrical Engineering, Computer Science and Information Tehcnology',
             'website_url' => 'izivkovic.com',
             'first_name' => 'Ivan',
             'last_name' => 'Zivkovic',
              'contact_number' => '0993403646'
        ]);
    }
}
