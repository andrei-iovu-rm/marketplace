<?php

namespace Tests\Feature\Admin;

use App\Http\Livewire\Admin\Offers\Create;
use App\Models\Offer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\Feature\FakersTrait;
use Tests\TestCase;

class OfferCreateTest extends TestCase
{
    use FakersTrait;

    public function test_create_page_contains_admin_offers_create_livewire_component()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $this->get('/admin/offers/create')->assertSeeLivewire('admin.offers.create');
    }

    public function test_create_page_form_works()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $test = Livewire::test(Create::class);
        $attributes = ['slug' => __FUNCTION__];
        foreach($this->generateFakeOfferAttributes($attributes) as $field => $value){
            if (in_array($field, ['user_id', 'thumbnail'])) {
                continue;
            }
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertSee('Offer Created!');

        $this->assertDatabaseHas('offers', [
            'slug' => __FUNCTION__,
        ]);
    }

    public function test_create_page_upload_works_for_images()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('thumbnail.jpg');

        $test = Livewire::test(Create::class);
        $attributes = ['slug' => __FUNCTION__, 'thumbnail' => $file];
        foreach ($this->generateFakeOfferAttributes($attributes) as $field => $value) {
            if ($field === 'user_id') {
                continue;
            }
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertSee('Offer Created!');

        $offer = Offer::where('slug', __FUNCTION__)->first();
        $this->assertNotNull($offer->thumbnail);
        Storage::disk('public')->assertExists($offer->thumbnail);
    }

    public function test_create_page_upload_does_not_works_for_non_images()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        Storage::fake('public');
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $test = Livewire::test(Create::class);
        $attributes = ['slug' => __FUNCTION__, 'thumbnail' => $file];
        foreach ($this->generateFakeOfferAttributes($attributes) as $field => $value) {
            if ($field === 'user_id') {
                continue;
            }
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertSee('The thumbnail must be an image.')
            ->assertHasErrors(['thumbnail' => 'image']);

        $this->assertDatabaseMissing('offers', [
            'slug' => __FUNCTION__,
        ]);
    }
}
