<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
trait HasFormattedDates
{
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ? \Carbon\Carbon::parse($value)->format('d-m-Y')
                : null
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ? \Carbon\Carbon::parse($value)->format('d-m-Y')
                : null
        );
    }
}
