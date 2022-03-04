<?php

namespace Tests\Feature;

use App\Http\Livewire\Session\Create;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\FakersTrait;

class SessionTest extends TestCase
{
    use FakersTrait;

    public function test_login_page_contains_session_create_livewire_component()
    {
        $this->get('/login')->assertSeeLivewire('session.create');
    }

    public function test_an_user_can_login_with_valid_data()
    {
        $this->createFakeUserRegular();

        $this->assertDatabaseHas('users', [
            'email' => $this->getFakeUserRegularAttributes()['email']
        ]);

        Livewire::test(Create::class)
            ->set('email', $this->getFakeUserRegularAttributes()['email'])
            ->set('password', $this->getFakeUserRegularAttributes()['password'])
            ->call('submitForm')
            ->assertHasNoErrors(['email', 'password']);

        $this->actingAs($this->userRegular);
        $this->assertAuthenticatedAs($this->userRegular);
    }

    public function test_redirect_to_homepage_after_login()
    {
        $this->createFakeUserRegular();

        Livewire::test(Create::class)
            ->set('email', $this->getFakeUserRegularAttributes()['email'])
            ->set('password', $this->getFakeUserRegularAttributes()['password'])
            ->call('submitForm')
            ->assertRedirect('/');

        $response = $this->get('/');
        $response->assertSee('Welcome back!');
    }

    public function test_an_user_cannot_login_with_wrong_email()
    {
        $this->createFakeUserRegular();

        Livewire::test(Create::class)
            ->set('email', 'dummy@example.com')
            ->set('password', $this->getFakeUserRegularAttributes()['password'])
            ->call('submitForm')
            ->assertHasErrors('email');
    }

    public function test_an_user_cannot_login_with_wrong_password()
    {
        $this->createFakeUserRegular();

        Livewire::test(Create::class)
            ->set('email', $this->getFakeUserRegularAttributes()['email'])
            ->set('password', 'dummy')
            ->call('submitForm')
            ->assertHasErrors('email');
    }

    public function test_an_user_cannot_login_with_no_data()
    {
        $this->createFakeUserRegular();

        Livewire::test(Create::class)
            ->set('email', '')
            ->set('password', '')
            ->call('submitForm')
            ->assertHasErrors(['email', 'password']);
    }

    public function test_a_logged_user_cannot_view_the_login_form()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $this->get('/login')
            ->assertRedirect('/');
    }
}
