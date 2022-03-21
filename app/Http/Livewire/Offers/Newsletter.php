<?php

namespace App\Http\Livewire\Offers;

use App\Services\NewsletterInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Newsletter extends Component
{
    public $subscribed;

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
        return view('livewire.offers.newsletter');
    }

    public function submitForm(NewsletterInterface $newsletter)
    {
        if ($this->subscribed) {
            $this->destroy($newsletter, $this->getEmail());
        } else {
            $this->store($newsletter, $this->getEmail());
        }
    }

    private function store(NewsletterInterface $newsletter, string $email)
    {
        try {
            $newsletter->subscribe($email);
            Cache::forever($newsletter->getCacheKey($email), true);
            $this->subscribed = true;
            $this->emit('emailSubscribed');
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => $email . ' could not be added to our newsletter list! ' . $e->getMessage()
            ]);
        }

        session()->flash('success', 'You are now signed up for our newsletter');
    }

    private function destroy(NewsletterInterface $newsletter, string $email)
    {
        try {
            $newsletter->deleteListMember($email);
            Cache::forget($newsletter->getCacheKey($email));
            $this->subscribed = false;
            $this->emit('emailUnsubscribed');
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => $email . ' could not be removed to our newsletter list! ' . $e->getMessage()
            ]);
        }

        session()->flash('success', 'You are now signed out from our newsletter');
    }
}
