<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Booking extends Pivot
{
    protected $table = 'bookings';

    protected $guarded = [];
}
