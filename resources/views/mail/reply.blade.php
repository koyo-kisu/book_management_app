<div>{{ $booking->user->name }}さんの予約申請が承認されました。</div>
<br>
<div>内容は下記のとおりです。</div>
<br>

<div>書籍名: {{ $booking->book->title }}</div>
<div>申請者: {{ $booking->user->name }}</div>
<div>貸出希望日: {{ $booking->booking_date_from->format('Y年m月d日') }}</div>
<div>返却予定日: {{ $booking->booking_date_to->format('Y年m月d日') }}</div>
<div>備考：{{ $booking->reply_comment }}</div>
<br>

<div>下記のURLから、予約状況を確認してください。</div>
<a href="/">URL</a>
