<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lending extends Model
{
    protected $fillable = [
        'lending_date',
        'return_date',
        'booking_id'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo('App\Booking', 'booking_id');
    }
}
