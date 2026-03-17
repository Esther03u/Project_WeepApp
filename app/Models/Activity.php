<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'activity_date',
        'location',
        'max_participants',
    ];

    protected $casts = [
        'activity_date' => 'datetime',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function isFullyBooked(): bool
    {
        return $this->registrations()->count() >= $this->max_participants;
    }

    public function availableSlots(): int
    {
        return $this->max_participants - $this->registrations()->count();
    }
}
