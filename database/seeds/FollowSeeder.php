<?php

use Illuminate\Database\Seeder;

use App\Follow;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Follow::create([
           'user_id' => 2,
           'follower_id' => 1,
        ]);
        Follow::create([
            'user_id' => 3,
            'follower_id' => 1,
        ]);
        Follow::create([
            'user_id' => 1,
           'follower_id' => 2,
        ]);
    }
}
