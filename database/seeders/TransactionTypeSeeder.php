<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::truncate();

        TransactionType::factory()->create(
            [
                'name' => 'Sell',
                'slug' => 'sell',
            ]
        );
        TransactionType::factory()->create(
            [
                'name' => 'Rent',
                'slug' => 'rent',
            ]
        );
    }
}
