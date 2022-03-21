<?php

namespace Tests\Feature;

use App\Http\Livewire\Offers\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Traits\FakersTrait;

class NewsletterTest extends TestCase
{
    use FakersTrait;

    public function test_home_page_contains_offers_newsletter_livewire_component_as_registered_user()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $this->get('/')->assertSeeLivewire('offers.newsletter');
    }

    public function test_home_page_doesnt_contains_offers_newsletter_livewire_component_as_unregistered_user()
    {
        $this->get('/')->assertDontSeeLivewire('offers.newsletter');
    }

    public function test_registered_user_can_subscribe()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $mock = $this->mock(MailchimpNewsletter::class, function (MockInterface $mock){
            $mock->shouldReceive('subscribe', 'getCacheKey')->once();
        });

        $cacheKey = MailchimpNewsletter::getCacheKey($this->userRegular->email);

        Cache::shouldReceive('remember')->once()
            ->with($cacheKey, 3600, \Closure::class)
            ->andReturn(false);
        Cache::shouldReceive('forget')->once()
            ->with(\Mockery::on(function() use ($cacheKey){
                return true;
            }))
            ->andReturn(true);

        Livewire::test(Newsletter::class)->call('submitForm', $mock)
            ->assertSee('You are now signed up for our newsletter')
            ->assertEmitted('emailSubscribed');
    }

    public function test_registered_user_can_unsubscribe()
    {
        $this->createFakeUserRegular();
        $this->actingAs($this->userRegular);
        $mock = $this->mock(MailchimpNewsletter::class, function (MockInterface $mock){
            $mock->shouldReceive('deleteListMember', 'getCacheKey')->once();
        });

        $cacheKey = MailchimpNewsletter::getCacheKey($this->userRegular->email);

        Cache::shouldReceive('remember')->once()
            ->with($cacheKey, 3600, \Closure::class)
            ->andReturn(true);
        Cache::shouldReceive('forget')
            ->with(\Mockery::on(function() use ($cacheKey){
                return true;
            }))
            ->andReturn(true);

        Livewire::test(Newsletter::class)->call('submitForm', $mock)
            ->assertSee('You are now signed out from our newsletter')
            ->assertEmitted('emailUnsubscribed');
    }
}
