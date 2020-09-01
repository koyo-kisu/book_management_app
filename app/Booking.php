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

    // 書籍IDでの検索メソッド
    public static function idSearched($num)
    {
        // 半角数字に変換
        $id_search = mb_convert_kana($num, "n");

        $booking_id = \App\Booking::where(['book_id' => $id_search])->get();

        return $booking_id;
    }
}
