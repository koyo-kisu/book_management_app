<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    // ランダムな書籍ID
    $book_id = App\Book::inRandomOrder()->first()->id;

    for($i = 0; $i < 20; $i++) {
        // ランダムな日付
        $date = $faker->dateTimeBetween('+1day', '+1month');

        $exists = App\Booking::where('book_id', '=', $book_id)
            ->where(function ($query) use ($date) {
                $query->where('booking_date_from', '<=', $date->format('Y-m-d'))
                    ->where('booking_date_to', '>=', $date->format('Y-m-d'));
            })
            ->orWhere(function ($query) use ($date) {
                $query->where('booking_date_from', '<=', $date->modify('+3day')->format('Y-m-d'))
                    ->where('booking_date_to', '>=', $date->format('Y-m-d'));
            })
            ->exists();

        if($exists)  continue;
        return [
            'user_id' => App\User::inRandomOrder()->first()->id,
            'book_id' => $book_id,
            'booking_date_from'=> $date->modify('-3day')->format('Y-m-d'),
            'booking_date_to'=> $date->modify('+3day')->format('Y-m-d'),
        ];
    }
});
