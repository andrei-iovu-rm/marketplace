<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();
        for($i = 1; $i <= City::count(); $i++) {
            Area::factory(random_int(2, 3))->create(
                [
                    'city_id' => $i
                ]
            );
        }
    }
}
