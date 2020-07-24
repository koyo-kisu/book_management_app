<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\BookingRequest;
use App\Mail\BookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        $user = \Auth::user();
        $request->merge(['user_id' => $user->id]);
        $booking = Booking::create($request->all());

        try {
            Mail::send(new BookingMail($booking));
        } catch (\Exception $e) {
            logger()->info($e->getMessage());
            logger()->info($e->getTraceAsString());
        }

        return redirect()->back();
    }
}
