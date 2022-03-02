<?php

namespace App\Http\Livewire\Admin\Offers;

use App\Models\Category;
use App\Models\County;
use App\Models\Offer;
use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, OffersTrait;

    public function mount(Offer $offer)
    {
        $this->offer = $offer;
        $this->title = $offer->title;
        $this->slug = $offer->slug;
        $this->excerpt = $offer->excerpt;
        $this->body = $offer->body;
        $this->price = $offer->price;
        $this->rooms = $offer->rooms;
        $this->baths = $offer->baths;
        $this->surface = $offer->surface;
        $this->featured = $offer->featured;
        $this->categories = Category::all();
        $this->category_id = $offer->category_id;
        $this->transaction_types = TransactionType::all();
        $this->transaction_type_id = $offer->transaction_type_id;
        $this->counties = County::all();
        $this->county_id = $offer->county_id;

        if(!empty($this->county_id)){
            $this->cities = $this->getCities();
            $this->city_id = $offer->city_id;
        }

        if(!empty($this->city_id)){
            $this->areas = $this->getAreas();
            $this->area_id = $offer->area_id;
        }
    }

    public function render()
    {
        return view('livewire.admin.offers.edit');
    }

    public function submitForm()
    {
        $this->offer->update($this->getAttributes());

        session()->flash('success', 'Offer Updated!');
    }
}
