<?php

namespace App\Http\Livewire\Offers;

use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\FavouriteOffer;
use App\Models\Offer;
use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public $search;
    public $categories;
    public $category;
    public $transaction_types;
    public $transaction_type;
    public $county;
    public $city;
    public $counties;
    public $cities;

    protected $queryString = ['search', 'category', 'transaction_type', 'county', 'city'];

    public function mount()
    {
        $this->categories = Category::all();
        $this->transaction_types = TransactionType::all();
        $this->counties = County::all();
        $this->cities = [];
    }

    public function updatedCounty()
    {
        $this->cities = !empty($this->county) ? City::with(['county'])->filter(['county' => $this->county])->get() : [];
        $this->city = '';
    }

    public function render()
    {
        return view('livewire.offers.data-tables',
        [
            'featured' => Offer::latest()->where('featured', true)->filter($this->getFilters())
                ->inRandomOrder()->limit(5)->get(),
            'offers' => Offer::latest()->filter($this->getFilters())
                ->paginate(15),
            'favourites' => FavouriteOffer::where('user_id', auth()->id())->get()->mapWithKeys(function ($item, $key){
                return [$item->id => $item->offer_id];
            })->toArray(),
        ]);
    }

    private function getFilters()
    {
        return [
            'search' => $this->search,
            'category' => $this->category,
            'transaction_type' => $this->transaction_type,
            'county' => $this->county,
            'city' => $this->city,
        ];
    }
}
