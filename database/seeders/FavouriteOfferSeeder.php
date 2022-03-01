<?php

namespace Database\Seeders;

use App\Models\FavouriteOffer;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavouriteOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FavouriteOffer::truncate();

        for($i = 1; $i <= 20; $i++) {
            do {
                $user_id = random_int(1, User::count());
                $offer_id = random_int(1, Offer::count());
            } while(FavouriteOffer::where('user_id', $user_id)->where('offer_id', $offer_id)->exists());

            FavouriteOffer::factory()->create(
                [
                    'user_id' => $user_id,
                    'offer_id' => $offer_id,
                ]
            );
        }
    }
}
