<?php

use Illuminate\Database\Seeder;
use App\PostLike;

class PostLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PostLike::create([
            'post_id' => 1,
            'user_id' => 2
        ]);
        //
        PostLike::create([
            'post_id' => 1,
            'user_id' => 3
        ]);
        PostLike::create([
            'post_id' => 2,
            'user_id' => 2
        ]);
        //
        PostLike::create([
            'post_id' => 2,
            'user_id' => 3
        ]);
        PostLike::create([
            'post_id' => 3,
            'user_id' => 2
        ]);
        //
        PostLike::create([
            'post_id' => 3,
            'user_id' => 3
        ]);
        PostLike::create([
            'post_id' => 4,
            'user_id' => 2
        ]);
        //
        PostLike::create([
            'post_id' => 4,
            'user_id' => 3
        ]);
        PostLike::create([
            'post_id' => 5,
            'user_id' => 2
        ]);
        //
        PostLike::create([
            'post_id' => 5,
            'user_id' => 3
        ]);
        PostLike::create([
            'post_id' => 6,
            'user_id' => 3
        ]);
    }
}
