<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['name'])]
#[Hidden(['created_at'])]
class PropertyType extends Model
{
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
