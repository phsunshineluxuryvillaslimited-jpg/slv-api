<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable([
    'property_id', 'poa', 'basic_price', 'original_price', 'total_reduction_percentage',
    'total_reduction_price', 'commission', 'communal_charges'
])]

#[Hidden(['property_id', 'created_at'])]
class PropertyPrice extends Model
{
    public function propertity(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
