<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserSkill;
use App\UserBusinessCategory;
use App\Social;
use App\Location;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'role_id' => 1,
            'username' => 'i1zivkovic',
            'slug' => 'i1zivkovic-'.time(),
            'email' => 'i1zivkovic@outlook.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => '2018-11-03 20:08:20',
            'is_active' => 1,
            'notify_applications' => 1
        ]);
         User::create([
            'role_id' => 2,
            'username' => 'i2zivkovic',
            'slug' => 'i2zivkovic-'.time(),
            'email' => 'i2zivkovic@outlook.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => '2018-11-03 20:08:20',
            'is_active' => 1,
            'notify_applications' => 1
        ]);
       User::create([
            'role_id' => 2,
            'username' => 'i3zivkovic',
            'slug' => 'i3zivkovic-'.time(),
            'email' => 'i3zivkovic@outlook.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => '2018-11-03 20:08:20',
            'is_active' => 1,
            'notify_applications' => 1
        ]);
        User::create([
            'role_id' => 2,
            'username' => 'i4zivkovic',
            'slug' => 'i4zivkovic-'.time(),
            'email' => 'i4zivkovic@outlook.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => '2018-11-03 20:08:20',
            'is_active' => 1,
            'notify_applications' => 1
        ]);

         UserSkill::create([
            'user_id' => $user->id,
            'skill_id' => 1
        ]);

         UserBusinessCategory::create([
            'user_id' => $user->id,
            'business_category_id' => 1
        ]);

         Social::create([
            'user_id' => $user->id,
            'instagram' => 'https://www.instagram.com/zika1601/?hl=hr',
            'facebook' => 'https://www.facebook.com/i1zivkovic',
            'linkedin' => 'https://www.linkedin.com/in/ivan-%C5%BEivkovi%C4%87-a3a17b150/',
            'github' => 'https://gitlab.com/i1zivkovic',
            'twitter' => 'https://twitter.com/zikaa1234',
            'google_plus' => 'https://plus.google.com/115975631602255992448',
        ]);

         Location::create([
            'user_id' => $user->id,
            'zip' => 31000,
            'city' => 'Osijek',
            'state' => 'Osječko-Baranjska',
            'street' => 'Vij.Ivana Meštrovića 74',
            'country' => 'Croatia'
        ]);
    }
}
