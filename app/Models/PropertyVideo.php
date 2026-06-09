<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id', 'embed_url_1', 'embed_url_2', 'virtual_tour_link'
])]
class PropertyVideo extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
