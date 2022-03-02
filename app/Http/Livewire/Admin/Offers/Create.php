<?php

namespace App\Http\Livewire\Admin\Offers;

use App\Models\Category;
use App\Models\County;
use App\Models\Offer;
use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, OffersTrait;

    public function mount()
    {
        $this->categories = Category::all();
        $this->transaction_types = TransactionType::all();
        $this->counties = County::all();
    }

    public function render()
    {
        return view('livewire.admin.offers.create');
    }

    public function submitForm()
    {
        Offer::create($this->getAttributes());

        session()->flash('success', 'Offer Created!');
    }
}
