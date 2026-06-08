<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['first_name', 'last_name', 'email', 'phone_number', 'mobile_number'])]
#[Hidden(['updated_at', 'created_at'])]
class Agent extends Model
{
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'agent_id');
    }
}
