<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id', 'amenities', 'airport', 'sea', 'public_transport', 'schools', 'resorts',
    'covered', 'attic', 'roof_garden', 'covered_veranda', 'uncovered_veranda',
    'covered_parking', 'basement', 'countyard', 'garden'
])]
class PropertyAmenities extends Model
{
    public function properties(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
