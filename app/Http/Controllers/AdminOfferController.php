<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class AdminOfferController extends Controller
{
    public function index()
    {
        return view('admin.offers.index');
    }

    public function create()
    {
        return view('admin.offers.create');
    }

    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', ['offer' => $offer]);
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();

        return back()->with('success', 'Offer Deleted!');
    }
}
