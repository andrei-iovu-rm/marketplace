<?php

namespace Tests\Feature;

use App\Http\Livewire\Register\Create;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\FakersTrait;

class RegisterTest extends TestCase
{
    use FakersTrait;

    public function test_register_page_contains_register_create_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('register.create');
    }

    public function test_create_an_account_with_valid_data()
    {
        $test = Livewire::test(Create::class);
        $attributes = ['username' => 'johndoetest', 'email' => 'johndoetest@example.com'];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm');

        $this->assertDatabaseHas('users', [
            'email' => 'johndoetest@example.com',
        ]);
    }

    public function test_redirect_to_homepage_after_registration()
    {
        $test = Livewire::test(Create::class);
        $attributes = ['username' => 'johndoetest', 'email' => 'johndoetest@example.com'];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertRedirect('/');

        $response = $this->get('/');
        $response->assertSee('Your account has been created!');
    }

    public function test_an_user_is_logged_in_after_registration()
    {
        $test = Livewire::test(Create::class);
        $attributes = ['username' => 'johndoetest', 'email' => 'johndoetest@example.com'];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm');

        $this->assertAuthenticated();
    }

    public function test_an_user_cannot_register_with_an_existing_username()
    {
        $this->assertDatabaseMissing('users', [
            'username' => $this->getFakeUserRegularAttributes()['username']
        ]);

        $this->createFakeUserRegular();

        $this->assertDatabasehas('users', [
            'username' => $this->getFakeUserRegularAttributes()['username']
        ]);

        $test = Livewire::test(Create::class);
        $attributes = ['username' => $this->userRegular->username];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertHasErrors('username');
    }

    public function test_an_user_cannot_register_with_an_existing_email()
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->getFakeUserRegularAttributes()['email']
        ]);

        $this->createFakeUserRegular();

        $this->assertDatabasehas('users', [
            'email' => $this->getFakeUserRegularAttributes()['email']
        ]);

        $test = Livewire::test(Create::class);
        $attributes = ['email' => $this->userRegular->email];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertHasErrors('email');
    }

    public function test_an_user_cannot_register_with_an_invalid_password()
    {
        $test = Livewire::test(Create::class);
        $attributes = ['password' => 'pass'];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertHasErrors('password');
    }

    public function test_an_user_cannot_register_without_role()
    {
        $test = Livewire::test(Create::class);
        $attributes = ['role' => ''];
        foreach($this->generateFakeUserAttributes($attributes) as $field => $value){
            $test->set($field, $value);
        }

        $test->call('submitForm')
            ->assertHasErrors('role');
    }

    public function test_a_logged_user_cannot_view_the_register_form()
    {
        $this->createFakeUserAdmin();
        $this->actingAs($this->userAdmin);

        $this->get('/register')
            ->assertRedirect('/');
    }
}
