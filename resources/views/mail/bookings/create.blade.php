<div>予約申請がありました。</div>
<br>
<div>内容は下記のとおりです。</div>
<br>

<div>書籍名: {{ $booking->book->title }}</div>
<div>申請者: {{ $booking->user->name }}</div>
<div>貸出希望日: {{ $booking->booking_date_from }}</div>
<div>返却予定日: {{ $booking->booking_date_to }}</div>
<br>

<div>下記のURLから、予約の承認を行ってください。</div>
<a href="/">URL</a>
