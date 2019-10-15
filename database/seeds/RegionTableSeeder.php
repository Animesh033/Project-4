<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the relation with one address
        factory(App\Models\Region::class, 10)->create()->each(function ($region) {
            $city = factory(App\Models\City::class)->make();
            $region->cities()->save($city);

            // Seed the relation with 5 purchases
            $states = factory(App\Models\State::class, 5)->make();
            $region->states()->saveMany($states);
        });
                    
    }
}
