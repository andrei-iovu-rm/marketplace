<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Validation\Rule;

class AdminOfferController extends Controller
{
    public function index()
    {
        return view('admin.offers.index', [
            'offers' => Offer::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.offers.create');
    }

    public function store()
    {
        $attributes = array_merge($this->validateOffer(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->storePublicly('thumbnails')
        ]);

        Offer::create($attributes);

        return redirect('/admin/offers')->with('success', 'Offer Created!');
    }

    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', ['offer' => $offer]);
    }

    public function update(Offer $offer)
    {
        $attributes = $this->validateOffer($offer);

        if ($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = request()->file('thumbnail')->storePublicly('thumbnails');
        }

        $offer->update($attributes);

        return back()->with('success', 'Offer Updated!');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();

        return back()->with('success', 'Offer Deleted!');
    }

    protected function validateOffer(?Offer $offer = null): array
    {
        $offer ??= new Offer();

        request()->merge(['featured' => request()->has('featured') ? true : false]);

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $offer->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('offers', 'slug')->ignore($offer)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'transaction_type_id' => ['required', Rule::exists('transaction_types', 'id')],
            'county_id' => ['required', Rule::exists('counties', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')->where(function ($query) {
                return $query->where('county_id', request('county_id'));
            })],
            'area_id' => ['required', Rule::exists('areas', 'id')->where(function ($query) {
                return $query->where('city_id', request('city_id'));
            })],
            'price' => 'required|numeric|min:100|max:1000000',
            'rooms' => 'required|numeric|min:1|max:10',
            'baths' => 'required|numeric|min:1|max:10',
            'surface' => 'required|numeric|min:10|max:1000',
            'featured' => 'boolean',
        ]);
    }
}
