<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category', 'county', 'city', 'area', 'transaction_type', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function ($query) use ($search){
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['county'] ?? false, function($query, $county) {
            $query->whereHas('county', function($query) use ($county) {
                $query->where('slug', $county);
            });
        });

        $query->when($filters['city'] ?? false, function($query, $city) {
            $query->whereHas('city', function($query) use ($city) {
                $query->where('slug', $city);
            });
        });

        $query->when($filters['transaction_type'] ?? false, function($query, $transaction_type) {
            $query->whereHas('transaction_type', function($query) use ($transaction_type) {
                $query->where('slug', $transaction_type);
            });
        });
    }
}
