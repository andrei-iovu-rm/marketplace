<?php

namespace App\Http\Controllers;

use App\Models\FavouriteOffer;
use App\Models\Offer;

class FavouriteOfferController extends Controller
{
    public function index()
    {
        return view('favourites.index', [
            'favourites' => FavouriteOffer::with('offer')->latest()->paginate(10)
        ]);
    }

    public function store(Offer $offer)
    {
        $attributes = [
                'user_id' => request()->user()->id,
                'offer_id' => $offer->id,
            ];

        FavouriteOffer::create($attributes);

        return back()->with('success', 'Offer added to favourites!');
    }

    public function destroy(Offer $offer)
    {
        FavouriteOffer::where('user_id', auth()->id())->where('offer_id', $offer->id)->delete();

        return back()->with('success', 'Offer deleted from favourites!');
    }
}
