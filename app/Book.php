<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

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

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function bookings(): BelongsToMany
    {
        return $this
            ->belongsToMany('App\User', 'bookings')
            ->withPivot(
                'booking_date_from',
                'booking_date_to',
                'status'
            );
    }

    // ユーザーがこの記事をいいね済みかどうかを返すメソッド
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    // 書籍名でのあいまい検索メソッド
    public static function searched(string $words = '')
    {
        $book = new Book;

        // 文字列を空白で分割し配列化
        $search_words = preg_split("/\s+/u", $words);

        // 各文字列であいまい検索
        $book = $book->where(function ($query) use ($search_words) {
            foreach ($search_words as $word) {
                $query->where('title', 'LIKE', '%'.$word.'%');
            }
        });

        return $book;
    }

    // 記事にいいねをしたユーザーの総数、つまりいいねの合計が求まります
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // 今日以降の予約情報を取得
    public function bookingsAfterToday(): BelongsToMany
    {
        return $this->bookings()
            ->whereDate('booking_date_from', '>=' ,Carbon::now())
            ->orderBy('booking_date_from', 'ASC');
    }
}
