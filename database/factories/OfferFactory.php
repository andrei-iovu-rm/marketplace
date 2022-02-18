<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'county_id' => County::factory(),
            'city_id' => City::factory(),
            'area_id' => Area::factory(),
            'transaction_type_id' => TransactionType::factory(),
            'user_id' => User::factory(),
            'title' => $this->faker->words(random_int(3, 5), true),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => '<p>' . implode('</p><p>', $this->faker->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'price' => random_int(300, 200000),
            'surface' => random_int(50, 150),
            'rooms' => random_int(1, 4),
            'baths' => random_int(1, 2),
            'featured' => $this->faker->boolean(),
        ];
    }
}
