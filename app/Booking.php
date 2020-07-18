<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Booking extends Pivot
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'description',
        'book_image',
        'state'
    ];
}
