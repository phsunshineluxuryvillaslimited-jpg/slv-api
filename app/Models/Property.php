<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\PropertyType;
use App\Models\PropertyAddress;
use App\Models\PropertyPrice;
use App\Models\PropertyAmenities;
use App\Models\PropertyContactDetail;
use App\Models\PropertyPhotos;
use App\Models\PropertyKeyFeature;
use App\Models\PropertyVideo;
use App\Models\PropertyExternalFeed;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'author_id', 'property_type_id', 'reference', 'description', 'title_deeds',
    'leasehold', 'bedrooms','bathrooms', 'build',
    'terrace', 'plot', 'plot_description', 'agent_id',
    'year_of_construction', 'pool', 'pool_description',
    'listing_type', 'plan_zone', 'sea_view', 'for_sale_board',
    'status', 'save_type'
])]

#[Hidden(['created_at', 'updated_at', 'author_id', 'property_type_id'])]
class Property extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function property_type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(PropertyAddress::class, 'property_id');
    }

    public function price(): HasOne
    {
        return $this->hasOne(PropertyPrice::class, 'property_id');
    }
    
    public function amenities(): HasOne
    {
        return $this->hasOne(PropertyAmenities::class);
    }

    public function contact(): HasOne
    {
        return $this->hasOne(PropertyContactDetail::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhotos::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(PropertyPhotos::class);
    }

    public function key_features(): HasMany
    {
        return $this->HasMany(PropertyKeyFeature::class);
    }

    public function video(): HasMany
    {
        return $this->hasMany(PropertyVideo::class);
    }

    public function networks(): HasMany
    {
        return $this->hasMany(PropertyNetworks::class);
    }

    public function externalFeeds(): HasOne
    {
        return $this->hasOne(PropertyExternalFeed::class);
    }

    public function getPropertyTypeAttribute(): string
    {
        return $this->attribute($this->property_type);
    }

    public function getBasicPriceAttribute(): ?float
    {
        return $this->price ? $this->price->basic_price : null;

        }

}