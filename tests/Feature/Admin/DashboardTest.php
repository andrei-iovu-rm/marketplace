<?php

namespace Tests\Feature\Admin;

use Tests\Feature\FakersTrait;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use FakersTrait;

    public function test_an_admin_can_access_dashboard(){
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('admin/offers');
    }

    public function test_a_regular_cant_access_dashboard(){
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $response = $this->get('/admin/dashboard');
        $response->assertForbidden();
    }

    public function test_an_admin_can_view_all_offers(){
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->get('/admin/offers');
        $response->assertOk();
    }

    public function test_a_regular_cant_view_all_offers(){
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $response = $this->get('/admin/offers');
        $response->assertForbidden();
    }

    public function test_an_admin_can_view_add_offer(){
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->get('/admin/offers/create');
        $response->assertOk();
    }

    public function test_a_regular_cant_view_add_offer(){
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $response = $this->get('/admin/offers/create');
        $response->assertForbidden();
    }

    public function test_an_admin_can_view_all_favourites(){
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->get('/favourites');
        $response->assertOk();
    }

    public function test_a_regular_can_view_all_favourites(){
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $response = $this->get('/favourites');
        $response->assertOk();
    }

    public function test_an_admin_can_log_out(){
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }

    public function test_a_regular_can_log_out(){
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }

    public function test_correct_view_all_offers_loaded()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);
        $response = $this->get('/admin/offers');
        $response->assertViewIs('admin.offers.index');
    }
}
