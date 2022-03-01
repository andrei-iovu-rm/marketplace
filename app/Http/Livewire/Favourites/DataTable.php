<?php

namespace App\Http\Livewire\Favourites;

use App\Models\FavouriteOffer;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.favourites.data-table', [
            'favourites' => FavouriteOffer::with('offer')->latest()->paginate(10)
        ]);
    }
}
