<?php

namespace Tests\Traits;

use App\Enums\UserRole;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\FavouriteOffer;
use App\Models\Offer;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;

trait FakersTrait
{
    use DatabaseTransactions, WithFaker;

    private $userAdmin;
    private $userRegular;

    private function getFakeUserAdminAttributes()
    {
        return [
            'username' => 'johndoetest',
            'name' => 'John Doe Test',
            'email' => 'johndoetest@example.com',
            'password' => 'password',
            'role' => UserRole::ADMIN->value,
        ];
    }

    private function getFakeUserRegularAttributes()
    {
        return [
            'username' => 'janedoetest',
            'name' => 'Jane Doe Test',
            'email' => 'janedoetest@example.com',
            'password' => 'password',
            'role' => UserRole::USER->value,
        ];
    }

    private function createFakeUserAdmin()
    {
        $this->userAdmin = $this->createFakeUser($this->getFakeUserAdminAttributes());
    }

    private function createFakeUserRegular()
    {
        $this->userRegular = $this->createFakeUser($this->getFakeUserRegularAttributes());
    }

    private function createFakeUser(array $attributes = [])
    {
        return User::factory()->create($this->generateFakeUserAttributes($attributes));
    }

    private function createFakeOffer(array $attributes = [])
    {
        return Offer::factory()->create($this->generateFakeOfferAttributes($attributes));
    }

    private function createFakeFavourite(array $attributes)
    {
        $user_id = random_int(1, User::count());
        $offer_id = random_int(1, Offer::count());

        return FavouriteOffer::factory()->create(array_merge([
            'user_id' => $user_id,
            'offer_id' => $offer_id,
        ], $attributes));
    }

    private function generateFakeOfferAttributes(array $attributes = [])
    {
        $category_id = random_int(1, Category::count());
        $county_id = random_int(1, County::count());
        $cities = City::where('county_id', $county_id)->get();
        $city_id = random_int($cities[0]->id, $cities[count($cities)-1]->id);

        $areas = Area::where('city_id', $city_id)->get();
        $area_id = random_int($areas[0]->id, $areas[count($areas)-1]->id);

        $transaction_type_id = random_int(1, TransactionType::count());

        return array_merge([
           'category_id' => $category_id,
           'county_id' => $county_id,
           'city_id' => $city_id,
           'area_id' => $area_id,
           'transaction_type_id' => $transaction_type_id,
           'user_id' => random_int(1, User::count()),
           'title' => $this->faker->words(random_int(3, 5), true),
           'slug' => $this->faker->unique()->slug(),
           'excerpt' => implode(' ', $this->faker->paragraphs(1)),
           'body' => implode(' ', $this->faker->paragraphs(1)),
           'price' => random_int(300, 200000),
           'surface' => random_int(50, 150),
           'rooms' => random_int(1, 4),
           'baths' => random_int(1, 2),
           'featured' => true,
           'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
        ], $attributes);
    }

    private function generateFakeUserAttributes(array $attributes = [])
    {
        return array_merge([
            'username' => $this->faker->unique()->userName(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'role' => random_int(1, 2) == 1 ? UserRole::ADMIN->value : UserRole::USER->value,
       ], $attributes);
    }
}
