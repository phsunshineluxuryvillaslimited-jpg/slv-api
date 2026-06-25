<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasFormattedDates;

#[Fillable([
    'name', 'address', 'telephone', 'mobile',
])]
class Bank extends Model
{
    use HasFormattedDates;
}
