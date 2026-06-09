<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'bank_name', 'category', 'first_name', 'last_name', 'email', 'phone_number', 'mobile_number',
    'mobile_number', 'type', 'source', 'notes', 'lawyer_first_name', 'lawyer_last_name',
    'lawyer_email', 'lawyer_telephone_day', 'lawyer_address'
])]
class Bank extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, "property_id");
    }
}
