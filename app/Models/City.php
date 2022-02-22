<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(City::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['county'] ?? false, function($query, $county) {
            $query->whereHas('county', function($query) use ($county) {
                $query->where('slug', $county);
            });
        });
    }
}
