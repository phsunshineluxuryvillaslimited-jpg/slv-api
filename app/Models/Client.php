<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormattedDates;

#[Fillable([
    'first_name', 'last_name', 'email', 'mobile_number', 'phone_number',
    'address', 'zipcode', 'nationality', 'id_card_number','passport_number',
    'preferred_language'
])]
class Client extends Model
{
    use HasFormattedDates;

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
