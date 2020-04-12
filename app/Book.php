<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'description',
        'book_image',
        'state',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

}
