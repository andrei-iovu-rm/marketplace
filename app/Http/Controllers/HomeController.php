<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\Offer;
use App\Models\TransactionType;

class HomeController extends Controller
{
    public function index()
    {
        return view(
            'home',
            [
                'featured' => Offer::filter(request(['category', 'transaction_type', 'county', 'city', 'search']))
                    ->where('featured', true)->inRandomOrder()->limit(5)->get(),
                'offers' => Offer::latest()
                    ->filter(request(['category', 'transaction_type', 'county', 'city', 'search']))->limit(15)->get(),

                'categories' => Category::all(),
                'counties' => County::with(['city'])->filter(request(['city']))->get(),
                'cities' => City::with(['county'])->filter(request(['county']))->get(),
                'transaction_types' => TransactionType::all(),
            ]
        );
    }
}