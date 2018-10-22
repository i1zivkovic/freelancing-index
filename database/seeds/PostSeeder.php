<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Post::create([
            'title' => 'This is a test post!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-post'
        ]);
         Post::create([
            'title' => 'This is a test post2!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-post2'
        ]);
         Post::create([
            'title' => 'This is a test post3!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-post3'
        ]);
         Post::create([
            'title' => 'This is a test post4!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-post3'
        ]);
         Post::create([
            'title' => 'This is a test post5!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-pos5'
        ]);
         Post::create([
            'title' => 'This is a test post6!',
            'description' => 'This is a test description. It could be longer but I"m not creative so I"m just gona write some shit and that is it.',
            'user_id' => 1,
            'slug' => 'this-is-a-test-post6'
        ]);
    }
}
