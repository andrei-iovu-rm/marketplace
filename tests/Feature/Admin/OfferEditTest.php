<?php

namespace Tests\Feature\Admin;

use App\Http\Livewire\Admin\Offers\Edit;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\Feature\FakersTrait;
use Tests\TestCase;

class OfferEditTest extends TestCase
{
    use FakersTrait;

    public function test_edit_page_contains_admin_offers_edit_livewire_component()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer();

        $this->get('/admin/offers/' . $offer->id . '/edit')->assertSeeLivewire('admin.offers.edit');
    }

    public function test_edit_page_form_works()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer([
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'body' => 'Body',
            'price' => 10000,
            'surface' => 50,
            'rooms' => 3,
            'baths' => 1,
            'featured' => false,
        ]);

        Livewire::test(Edit::class, ['offer' => $offer])
            ->set('title', 'New Title')
            ->set('excerpt', 'New Excerpt')
            ->set('body', 'New Body')
            ->set('price', 100000)
            ->set('surface', 100)
            ->set('rooms', 4)
            ->set('baths', 2)
            ->set('featured', true)
            ->call('submitForm')
            ->assertSee('Offer Updated!');
    }

    public function test_edit_page_upload_works_for_images()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer([
            'thumbnail' => null,
        ]);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('thumbnail.jpg');

        Livewire::test(Edit::class, ['offer' => $offer])
            ->set('thumbnail', $file)
            ->call('submitForm')
            ->assertSee('Offer Updated!');

        $offer->refresh();
        $this->assertNotNull($offer->thumbnail);
        Storage::disk('public')->assertExists($offer->thumbnail);
    }

    public function test_edit_page_upload_does_not_works_for_non_images()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer([
            'thumbnail' => null,
        ]);

        Storage::fake('public');
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        Livewire::test(Edit::class, ['offer' => $offer])
            ->set('thumbnail', $file)
            ->call('submitForm')
            ->assertSee('The thumbnail must be an image.')
            ->assertHasErrors(['thumbnail' => 'image']);

        $offer->refresh();
        $this->assertNull($offer->thumbnail);
        Storage::disk('public')->assertMissing($offer->thumbnail);
    }
}
