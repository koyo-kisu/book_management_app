<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Booking extends Pivot
{
    protected $table = 'bookings';

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}