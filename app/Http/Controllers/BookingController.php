<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
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

        return redirect()->back()->with('flash_success', '予約申請しました。');
    }

    public function index()
    {
        $applies = \App\Booking::orderBy('is_approved', 'asc')
            ->orderBy('booking_date_from', 'asc')
            ->paginate(50);

        return view('bookings.index', [
            'applies' => $applies,
        ]);
    }

    public function show(Booking $id)
    {
        // $bk_id = \App\Booking::findOrFail($id);

        return view('bookings.show');
    }

    public function cancel(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('flash_success', '削除しました。');
    }
}
