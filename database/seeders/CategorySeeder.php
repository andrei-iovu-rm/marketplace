<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::factory()->create(
            [
                'name' => 'Apartments',
                'slug' => 'apartments'
            ]
        );
        Category::factory()->create(
            [
                'name' => 'Houses',
                'slug' => 'houses'
            ]
        );
    }
}
