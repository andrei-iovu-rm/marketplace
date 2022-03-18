<?php

namespace App\Models\Admin;

use App\Models\Offer as OfferPublic;
use App\Models\Scopes\MyOffersScope;
use Parental\HasParent;

class Offer extends OfferPublic
{
    use HasParent;

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MyOffersScope());
    }
}
