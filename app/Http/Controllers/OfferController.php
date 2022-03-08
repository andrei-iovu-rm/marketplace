<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        return view('offers.index');
    }

    public function show(Offer $offer)
    {
        return view('offers.show', ['offer' => $offer]);
    }
}
