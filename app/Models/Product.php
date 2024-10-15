<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('event_title', 'like', '%'.$search.'%')
                ->orWhere('event_detail', 'like', '%'.$search.'%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['merchant'] ?? false, fn ($query, $merchant) => $query->whereHas('merchant', fn ($query) => $query->where('id', $merchant)
        )
        );

        $query->when($filters['location'] ?? false, function ($query, $location) {
            $query->where('event_location', $location);
        });

        // $query->when(isset($filters['min_price']) && isset($filters['max_price']), function ($query) use ($filters) {
        //     $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
        // });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'event_title',
            ],
        ];
    }
}
