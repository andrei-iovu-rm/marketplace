<?php

namespace App\Http\Livewire\Admin\Offers;

use App\Models\Area;
use App\Models\City;
use App\Models\Offer;
use Illuminate\Validation\Rule;

trait OffersTrait
{
    public $offer = null;
    public $title;
    public $slug;
    public $thumbnail;
    public $excerpt;
    public $body;
    public $categories;
    public $category_id;
    public $transaction_types;
    public $transaction_type_id;
    public $counties;
    public $county_id = 0;
    public $cities = [];
    public $city_id = 0;
    public $areas = [];
    public $area_id = 0;
    public $price;
    public $rooms;
    public $baths;
    public $surface;
    public $featured = false;

    protected $rules = [];

    public function updatedThumbnail()
    {
        $this->validateOffer();
    }

    public function updatedCountyid()
    {
        $this->cities = $this->getCities();
        $this->updatedCityid();
    }

    public function updatedCityid()
    {
        $this->areas = $this->getAreas();
    }

    private function getCities()
    {
        if(!empty($this->county_id)) {
            return City::where('county_id', $this->county_id)->get();
        }
        $this->city_id = 0;
        return [];
    }

    private function getAreas()
    {
        if(!empty($this->city_id)) {
            return Area::where('city_id', $this->city_id)->get();
        }
        $this->area_id = 0;
        return [];
    }

    private function validateOffer()
    {
        $offer = $this->offer ?? new Offer();
        $this->rules = [
            'title' => 'required',
            'thumbnail' => ['nullable', 'sometimes', 'image', 'max:2048'],
            'slug' => ['required', Rule::unique('offers', 'slug')->ignore($offer)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'transaction_type_id' => ['required', Rule::exists('transaction_types', 'id')],
            'county_id' => ['required', Rule::exists('counties', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')->where(function ($query) {
                return $query->where('county_id', $this->county_id);
            })],
            'area_id' => ['required', Rule::exists('areas', 'id')->where(function ($query) {
                return $query->where('city_id', $this->city_id);
            })],
            'price' => 'required|numeric|min:100|max:1000000',
            'rooms' => 'required|numeric|min:1|max:10',
            'baths' => 'required|numeric|min:1|max:10',
            'surface' => 'required|numeric|min:10|max:1000',
            'featured' => 'boolean',
        ];

        $this->validate();
    }

    private function getAttributes()
    {
        $this->validateOffer();

        $imageToShow = isset($this->offer) && $this->offer->thumbnail ?? null;

        $attributes = [
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->storePublicly('thumbnails') : $imageToShow,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'transaction_type_id' => $this->transaction_type_id,
            'county_id' => $this->county_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'price' => $this->price,
            'rooms' => $this->rooms,
            'baths' => $this->baths,
            'surface' => $this->surface,
            'featured' => $this->featured,
        ];

        if(!isset($this->offer)) {
            $attributes['user_id'] = auth()->user()->id;
        }

        return $attributes;
    }
}
