<?php

use Illuminate\Database\Seeder;
use App\BusinessCategory;

class BusinessCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BusinessCategory::create([
            'name' => 'Graphic Design',
        ]);
          //
          BusinessCategory::create([
            'name' => 'Programming',
        ]);
    }
}
