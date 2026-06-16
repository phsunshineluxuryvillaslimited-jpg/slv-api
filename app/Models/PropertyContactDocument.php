<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_contact_detail_id', 'category', 'first_name', 'last_name', 'email', 'phone_number', 'mobile_number',
    'mobile_number', 'type', 'source', 'notes', 'lawyer_first_name', 'lawyer_last_name',
    'lawyer_email', 'lawyer_phone_number', 'lawyer_address',
])]
class PropertyContactDocument extends Model
{
    const UPDATED_AT = null;

    public function contactDetail(): BelongsTo
    {
        return $this->belongsTo(PropertyContactDetail::class, 'property_contact_detail_id');
    }
}
