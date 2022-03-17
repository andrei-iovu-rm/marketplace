<?php

namespace App\Nova;

use App\Nova\Filters\OffersByCategory;
use Illuminate\Http\Request;

class MyOffer extends Offer
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Admin\Offer::class;

    public function filters(Request $request)
    {
        return [
            new OffersByCategory(),
        ];
    }
}
