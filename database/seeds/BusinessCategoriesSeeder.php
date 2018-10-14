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
            'name' => 'IT',
        ]);
          //
          BusinessCategory::create([
            'name' => 'Communcations',
        ]);
          BusinessCategory::create([
            'name' => 'Civil Engineering',
        ]);
          BusinessCategory::create([
            'name' => 'Food',
        ]);
          BusinessCategory::create([
            'name' => 'Animals',
        ]);
          BusinessCategory::create([
            'name' => 'Technology',
        ]);
    }
}
