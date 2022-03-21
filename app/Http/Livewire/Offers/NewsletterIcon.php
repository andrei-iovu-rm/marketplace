<?php

namespace App\Http\Livewire\Offers;

use App\Services\NewsletterInterface;
use Livewire\Component;

class NewsletterIcon extends Component
{
    public $subscribed;

    protected $listeners = [
        'emailSubscribed' => 'eventEmailSubscribed',
        'emailUnsubscribed' => 'eventEmailUnsubscribed'
    ];

    private function getEmail()
    {
        return auth()?->user()?->email;
    }

    public function mount(NewsletterInterface $newsletter)
    {
        $this->subscribed = $newsletter->emailIsSubscribed($this->getEmail());
    }

    public function render()
    {
        return view('livewire.offers.newsletter-icon');
    }

    public function eventEmailSubscribed()
    {
        $this->subscribed = true;
    }

    public function eventEmailUnsubscribed()
    {
        $this->subscribed = false;
    }
}
