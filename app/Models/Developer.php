<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'first_name', 'last_name', 'email', 'mobile_number', 'phone_number'
])]
#[Hidden(['updated_at', 'created_at'])]
class Developer extends Model
{
    //
}
