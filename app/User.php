<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Book', 'likes')->withTimestamps();
    }

    public function bookings(): BelongsToMany
    {
        return $this
            ->belongsToMany('App\Book', 'bookings')
            ->withPivot(
                'id',
                'booking_date_from',
                'booking_date_to',
                'is_approved',
            );
    }

    // 今日以降の予約した本を取得
    public function bookingsAfterToday(): BelongsToMany
    {
        return $this->bookings()
            ->whereDate('booking_date_from', '>=' ,Carbon::now())
            ->orderBy('booking_date_from', 'DESC');
    }

    // 貸出履歴を取得
    public function bookingsBeforeToday(): BelongsToMany
    {
        return $this->bookings()
            ->whereDate('booking_date_from', '<' ,Carbon::now())
            ->orderBy('booking_date_from', 'DESC');
    }
}
