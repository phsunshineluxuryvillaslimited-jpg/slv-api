<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id', 'contact_email', 'sort_code', 'account_name', 'account_number', 'address', 'contact_name', 
    'contact_phone', 'bank_id', 'branch', 'account_ref'
])]
class PropertyBank extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
