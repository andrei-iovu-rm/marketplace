<?php

namespace App\Http\Controllers;

use App\Models\FavouriteOffer;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        return view('offers.index');
    }

    public function show(Offer $offer)
    {
        return view('offers.show', [
            'offer' => $offer,
            'favourites' => FavouriteOffer::where('user_id', auth()->id())->get()->mapWithKeys(function ($item, $key){
                return [$item->id => $item->offer_id];
            })->toArray(),
        ]);
    }
}
