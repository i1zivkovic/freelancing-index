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
            'is_active' => 1,
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
            'facebook' => 'https://www.facebook.com/i1zivkovic'
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
