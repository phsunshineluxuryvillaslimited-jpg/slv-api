<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'property_type_id', 'reference', 'description', 'title_deeds',
    'leasehold', 'bedrooms', 'bathrooms', 'area_size', 'plot', 'plot_description',
    'managing_agent_user_id', 'year_of_construction', 'pool', 'pool_description',
    'listing_type', 'plan_zone', 'sea_view', 'for_sale_board',
    'status', 'save_type',
])]

#[Hidden(['created_at', 'updated_at', 'author_id', 'property_type_id'])]
class Property extends Model
{
    use Blameable;

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'managing_agent_user_id');
    }

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
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
        return $this->hasMany(PropertyFile::class)->where('type', 'gallery'); //set for gallery images
    }
    
    public function floorPlan(): HasMany
    {
        return $this->hasMany(PropertyFile::class)->where('type', 'floorplan'); // Set for floor plan category
    }

    public function keyFeatures(): HasMany
    {
        return $this->HasMany(PropertyKeyFeature::class);
    }

    public function video(): HasOne
    {
        return $this->HasOne(PropertyVideo::class);
    }

    public function networks(): HasMany
    {
        return $this->hasMany(PropertyNetworks::class);
    }

    public function externalFeeds(): HasOne
    {
        return $this->hasOne(PropertyExternalFeed::class);
    }

    public function bank(): HasOne
    {
        return $this->hasOne(Bank::class);
    }

    // public function getPropertyTypeAttribute(): string
    // {
    //     // return $this->attribute($this->propertyType?->name);
    //     return $this->propertyType?->name ?? '';
    // }

    public function getBasicPriceAttribute(): ?float
    {
        return $this->price ? $this->price->basic_price : null;
    }
}
