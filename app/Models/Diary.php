<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diary extends Model
{
    protected $fillable = [
        'event_type',
        'assigned_to',
        'event_date',
        'event_time',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Combined date + time as a single Carbon instance, e.g. for sorting or
     * for mapping to Outlook's start/end fields later.
     */
    protected function startsAt(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->event_date->format('Y-m-d').' '.$this->event_time),
        );
    }

    /**
     * Tailwind classes for the colored pill badge, keyed by event type.
     */
    public static function badgeClasses(string $eventType): string
    {
        return match ($eventType) {
            'Viewing' => 'bg-yellow-100 text-yellow-700',
            'Take-on' => 'bg-blue-100 text-blue-600',
            'Miscellaneous' => 'bg-green-100 text-green-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}