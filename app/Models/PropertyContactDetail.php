<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'property_id', 'category', 'first_name', 'last_name', 'email', 'phone_number', 'mobile_number',
    'mobile_number', 'type', 'source', 'notes', 'lawyer_first_name', 'lawyer_last_name',
    'lawyer_email', 'lawyer_phone_number', 'lawyer_address'
])]
class PropertyContactDetail extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }

    public function documents(): HasMany
    {
        return $this->hasMany(PropertyContactDocument::class, 'property_contact_detail_id');
    }
}
