<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Booking;
use App\Http\Requests\BookingRequest;
use App\Mail\BookingMail;
use App\Mail\ReplyMail;
use App\Mail\RejectMail;
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
        $applies = \App\Booking::orderBy('status', 'asc')
            ->orderBy('booking_date_from', 'asc')
            ->orwhere(['status' => '0'])
            ->orwhere(['status' => '1'])
            ->paginate(50);

        return view('bookings.index', [
            'applies' => $applies,
        ]);
    }

    public function show(Booking $booking)
    {
        $booking = \App\Booking::where(['id' => $booking->id])->first();
        $booking_start = $booking->booking_date_from->format('Y年m月d日');
        $booking_end = $booking->booking_date_to->format('Y年m月d日');
        $booking_created_date = $booking->created_at->format('Y年m月d日');

        return view('bookings.show', [
            'booking' => $booking,
            'booking_start' => $booking_start,
            'booking_end' => $booking_end,
            'booking_created_date' => $booking_created_date,
        ]);
    }

    // 承認メール送信処理
    public function approve(Request $request, Booking $booking)
    {
        // 備考欄データ保存
        $booking->fill([
            'reply_comment' => $request->reply_comment,
            'status' => '1'
        ])->save();

        // メール送信処理
        $aa = $request->merge(['user_id' => $booking->user->id]);
        // dd($aa);

        try {
            Mail::send(new ReplyMail($booking));
        } catch (\Exception $e) {
            logger()->info($e->getMessage());
            logger()->info($e->getTraceAsString());
        }

        return redirect()->route('bookings.index')->with('flash_success', '予約を承認しました。');
    }

    // 予約取り消し処理
    public function reject(Request $request, Booking $booking)
    {
        // 備考欄データ保存
        $booking->fill([
            'reply_comment' => $request->reply_comment,
            'status' => '2'
        ])->save();

        // メール送信処理
        $user = \Auth::user();
        $request->merge(['user_id' => $user->id]);

        try {
            Mail::send(new RejectMail($booking));
        } catch (\Exception $e) {
            logger()->info($e->getMessage());
            logger()->info($e->getTraceAsString());
        }

        return redirect()->route('bookings.index')->with('flash_success', '予約を却下しました。');
    }
}
