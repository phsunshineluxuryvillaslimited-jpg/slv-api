<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable([
    'property_id', 'type', 'url', 'caption', 'sort_order',
    'photo_update_date'
])]
#[Hidden(['property_id', 'created_at'])]class PropertyPhotos extends Model
{
    public function properties(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
