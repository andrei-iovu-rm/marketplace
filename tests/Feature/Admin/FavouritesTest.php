<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Tests\Traits\FakersTrait;

class FavouritesTest extends TestCase
{
    use FakersTrait;

    public function test_favourites_page_contains_datatables_livewire_component_as_admin()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $this->get('/favourites')->assertSeeLivewire('favourites.data-table');
    }

    public function test_main_page_contains_datatables_livewire_component_as_regular()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $this->get('/favourites')->assertSeeLivewire('favourites.data-table');
    }

    public function test_an_admin_can_delete()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $offer = $this->createFakeOffer([]);
        $favourite = $this->createFakeFavourite([
           'user_id' => $this->userAdmin->id,
           'offer_id' => $offer->id,
        ]);

        $response = $this->delete('/favourite/' . $offer->id);
        $response->assertStatus(302);
        $this->assertModelMissing($favourite);
    }

    public function test_a_regular_can_delete()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);

        $offer = $this->createFakeOffer([]);
        $favourite = $this->createFakeFavourite([
            'user_id' => $this->userRegular->id,
            'offer_id' => $offer->id,
        ]);

        $response = $this->delete('/favourite/' . $offer->id);
        $response->assertStatus(302);
        $this->assertModelMissing($favourite);
    }
}
