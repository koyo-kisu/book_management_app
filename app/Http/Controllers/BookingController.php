<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Booking;
use App\Lending;
use App\Http\Requests\BookingRequest;
use App\Mail\BookingCancelMail;
use App\Mail\BookingMail;
use App\Mail\ReplyMail;
use App\Mail\RejectMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index(Request $request)
    {
        $book_id = $request->input('book_id');
        $status = $request->input('status');

        $applies = \App\Booking::query()
            ->when(!is_null($status), function($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($book_id, function($query) use ($book_id) {
                $book_id = mb_convert_kana($book_id, "n");
                $query->where('book_id', $book_id);
            })
            ->orderBy('status', 'asc')
            ->orderBy('booking_date_from', 'asc')
            ->paginate(50);

        $query = [
            'book_id' => $book_id,
            'status' => $status,
        ];

        return view('bookings.index', [
            'applies' => $applies,
            'query' => $query,
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
            'status' => '4'
        ])->save();

        // メール送信処理
        try {
            Mail::send(new RejectMail($booking));
        } catch (\Exception $e) {
            logger()->info($e->getMessage());
            logger()->info($e->getTraceAsString());
        }

        return redirect()->route('bookings.index')->with('flash_success', '予約を却下しました。');
    }

    public function cancel(Booking $booking)
    {
        try {
            Mail::send(new BookingCancelMail($booking));
        } catch (\Exception $e) {
            logger()->info($e->getMessage());
            logger()->info($e->getTraceAsString());
        }
        $booking->delete();

        return redirect()->back()->with('flash_success', '削除しました。');
    }

    public function lending(Request $request, Booking $booking, Lending $lending)
    {
        $today = date("Y-m-d");
        $lending->create([
            'lending_date' => $today,
            'booking_id' => $booking->id,
        ]);

        $booking->fill([
            'status' => $request->lending,
        ])->save();

        return redirect()->route('bookings.index')->with('flash_success', '本を貸出しました。');
    }

    public function returned(Request $request, Booking $booking, Lending $lending)
    {
        $returned = \App\lending::where(['booking_id' => $request->booking_id])->first();
        $today = date("Y-m-d");
        $returned->fill([
            'return_date' => $today,
        ])->save();

        $booking->fill([
            'status' => $request->returned,
        ])->save();

        return redirect()->route('bookings.index')->with('flash_success', '本を返却しました。');
    }

}
