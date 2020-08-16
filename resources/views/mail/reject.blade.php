<div>{{ $booking->user->name }}さんの予約を取り消しました。</div>
<br>
<div>内容は下記のとおりです。</div>
<br>

<div>書籍名: {{ $booking->book->title }}</div>
<div>申請者: {{ $booking->user->name }}</div>
<div>貸出希望日: {{ $booking->booking_date_from }}</div>
<div>返却予定日: {{ $booking->booking_date_to }}</div>
<div>却下理由：{{ $booking->reply_comment }}</div>
<br>

<div>お手数ですが下記のURLから、予約の申請を再度行ってください。</div>
<a href="/">URL</a>
