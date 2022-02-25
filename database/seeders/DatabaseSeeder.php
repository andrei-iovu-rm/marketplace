<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        (new CategorySeeder())->run();
        (new CountySeeder())->run();
        (new CitySeeder())->run();
        (new AreaSeeder())->run();
        (new TransactionTypeSeeder())->run();
        (new UserSeeder())->run();
        (new OfferSeeder())->run();
        (new FavouriteOfferSeeder())->run();
    }
}
