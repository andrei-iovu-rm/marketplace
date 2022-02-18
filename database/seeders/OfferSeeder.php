<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\Offer;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::truncate();

        for($i = 1; $i <= 50; $i++) {
            $county_id = random_int(1, County::count());
            $cities = City::where('county_id', $county_id)->get();
            $city_id = random_int($cities[0]->id, $cities[count($cities)-1]->id);

            $areas = Area::where('city_id', $city_id)->get();
            $area_id = random_int($areas[0]->id, $areas[count($areas)-1]->id);

            $transaction_type_id = random_int(1, TransactionType::count());

            Offer::factory()->create(
                [
                    'category_id' => random_int(1, Category::count()),
                    'county_id' => $county_id,
                    'city_id' => $city_id,
                    'area_id' => $area_id,
                    'transaction_type_id' => $transaction_type_id,
                    'user_id' => random_int(1, User::count()),
                ]
            );
        }
    }
}
