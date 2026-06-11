<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id', 'region', 'town_city', 'locality', 'latitude',
    'longitude', 'accuracy', 'map_address', 'map_accuracy'
])]
class PropertyAddress extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
