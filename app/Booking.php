<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

class Booking extends Pivot
{
    protected $table = 'bookings';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'booking_date_from',
        'booking_date_to',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
