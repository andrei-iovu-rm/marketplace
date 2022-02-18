<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();
        for($i = 1; $i <= County::count(); $i++) {
            City::factory(random_int(2, 3))->create(
                [
                    'county_id' => $i
                ]
            );
        }
    }
}
