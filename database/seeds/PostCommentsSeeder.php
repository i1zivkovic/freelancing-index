<?php

use Illuminate\Database\Seeder;
use App\PostComment;

class PostCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        PostComment::create([
            'post_id' => 1,
            'user_id' => 2,
            'comment' => 'Nice post!',
        ]);
        PostComment::create([
            'post_id' => 1,
            'user_id' => 3,
            'comment' => 'Nice post too!',
        ]);
        PostComment::create([
            'post_id' => 2,
            'user_id' => 2,
            'comment' => 'Nice post!',
        ]);
        PostComment::create([
            'post_id' => 1,
            'user_id' => 3,
            'comment' => 'Nice post too!',
        ]);
    }
}
