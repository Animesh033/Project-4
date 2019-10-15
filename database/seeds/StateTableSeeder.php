<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\State::class, 10)->create();

        // Create 10 records of customers
                factory(App\Models\State::class, 5)->create()->each(function ($state) {
                    // Seed the relation with 5 purchases
                    $cities = factory(App\Models\City::class, 5)->make();
                    $state->cities()->saveMany($cities);
                });
    }
}
