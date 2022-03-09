<?php

namespace App\Http\Livewire\Favourites;

use App\Models\FavouriteOffer;
use App\Models\Offer;
use Livewire\Component;

class Create extends Component
{
    public $offer;
    public $favourites;

    public function mount(Offer $offer, $favourites)
    {
        $this->offer = $offer;
        $this->favourites = $favourites;
    }

    public function render()
    {
        return view('livewire.favourites.create');
    }

    public function submitForm()
    {
        if (in_array($this->offer->id, $this->favourites) !== false) {
            $this->destroy();
        } else {
            $this->store();
        }
    }

    private function store()
    {
        $attributes = [
            'user_id' => auth()->user()->id,
            'offer_id' => $this->offer->id,
        ];

        $favourite = FavouriteOffer::create($attributes);
        $this->favourites[$favourite->id] = $this->offer->id;

        session()->flash('success', 'Offer added to favourites!');
    }

    private function destroy()
    {
        $favourite = FavouriteOffer::where('user_id', auth()->user()->id)->where('offer_id', $this->offer->id)->first();
        $favourite->delete();
        unset($this->favourites[$favourite->id]);

        session()->flash('success', 'Offer deleted from favourites!');
    }
}
