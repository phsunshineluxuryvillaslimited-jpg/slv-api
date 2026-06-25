<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasFormattedDates;

#[Fillable(['first_name', 'last_name', 'email', 'phone_number', 'mobile_number', 'company'])]
class Agent extends Model
{
    use HasFormattedDates;
    
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'agent_id');
    }
}
