<?php

namespace Tests\Feature\Admin;

use App\Http\Livewire\Admin\Offers\DataTables;
use Livewire\Livewire;
use Tests\Feature\FakersTrait;
use Tests\TestCase;

class AllOffersTest extends TestCase
{
    use FakersTrait;

    public function test_all_offers_page_contains_datatables_livewire_component()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $this->get('/admin/offers')->assertSeeLivewire('admin.offers.data-tables');
    }

    public function test_datatables_featured_checkbox_works_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerA = $this->createFakeOffer([
            'title' => 'Asperiores Repellendus Et Ratione Voluptate',
            'featured' => true
        ]);
        $offerB = $this->createFakeOffer([
            'title' => 'Est Alias Ut Temporibus Est',
            'featured' => false
        ]);

        Livewire::test(DataTables::class)
            ->assertSee($offerA->title)
            ->assertDontSee($offerB->title)
            ->set('featured', false)
            ->assertSee($offerB->title)
            ->assertDontSee($offerA->title);
    }

    public function test_datatables_searches_title_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerA = $this->createFakeOffer([
            'title' => 'Asperiores Repellendus Et Ratione Voluptate',
        ]);
        $offerB = $this->createFakeOffer([
            'title' => 'Est Alias Ut Temporibus Est',
        ]);

        Livewire::test(DataTables::class)
            ->set('search', 'Asperiores')
            ->assertSee($offerA->title)
            ->assertDontSee($offerB->title);
    }

    public function test_datatables_searches_excerpt_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerA = $this->createFakeOffer([
            'title' => 'Asperiores Repellendus Et Ratione Voluptate',
            'excerpt' => 'Veritatis asperiores praesentium voluptatem doloremque officia. Voluptatibus sunt omnis sed deleniti. Nihil adipisci aut earum deleniti non.',
        ]);
        $offerB = $this->createFakeOffer([
            'title' => 'Est Alias Ut Temporibus Est',
            'excerpt' => 'Alias voluptate et maiores tenetur inventore sit. Temporibus quia sit dolor modi nisi numquam.',
        ]);

        Livewire::test(DataTables::class)
            ->set('search', 'asperiores')
            ->assertSee($offerA->title)
            ->assertDontSee($offerB->title);
    }

    public function test_datatables_dropdown_category_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerA = $this->createFakeOffer([
            'category_id' => 1,
            'title' => 'Asperiores Repellendus Et Ratione Voluptate',
        ]);
        $offerB = $this->createFakeOffer([
            'category_id' => 2,
            'title' => 'Est Alias Ut Temporibus Est',
        ]);

        Livewire::test(DataTables::class)
            ->set('category', 1)
            ->assertSee($offerA->title)
            ->assertDontSee($offerB->title);
    }

    public function test_datatables_dropdown_transaction_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerA = $this->createFakeOffer([
            'transaction_type_id' => 1,
            'title' => 'Asperiores Repellendus Et Ratione Voluptate',
        ]);
        $offerB = $this->createFakeOffer([
            'transaction_type_id' => 2,
            'title' => 'Est Alias Ut Temporibus Est',
        ]);

        Livewire::test(DataTables::class)
            ->set('transaction_type', 1)
            ->assertSee($offerA->title)
            ->assertDontSee($offerB->title);
    }

    public function test_datatables_sorts_title_asc_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerC = $this->createFakeOffer([
            'title' => 'C Offer Title',
        ]);
        $offerA = $this->createFakeOffer([
            'title' => 'A Offer Title',
        ]);
        $offerB = $this->createFakeOffer([
            'title' => 'B Offer Title',
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'title')
            ->assertSeeInOrder([$offerA->title, $offerB->title, $offerC->title]);
    }

    public function test_datatables_sorts_title_desc_correctly()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $offerC = $this->createFakeOffer([
            'title' => 'C Offer Title',
        ]);
        $offerA = $this->createFakeOffer([
            'title' => 'A Offer Title',
        ]);
        $offerB = $this->createFakeOffer([
            'title' => 'B Offer Title',
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'title')
            ->call('sortBy', 'title')
            ->assertSeeInOrder([$offerC->title, $offerB->title, $offerA->title]);
    }

    public function test_an_admin_can_delete()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer([]);

        $response = $this->delete('/admin/offers/' . $offer->id);
        $response->assertStatus(302);
        $this->assertModelMissing($offer);
    }

    public function test_a_regular_cant_delete()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);

        $offer = $this->createFakeOffer([]);

        $response = $this->delete('/admin/offers/' . $offer->id);
        $response->assertForbidden();
    }
}
