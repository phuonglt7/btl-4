<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    Tài khoản: {{ $user->username}} <br>
    Email : {{  $user->email }} <br>
    Bạn mượn  {{ $book->book_name}} <br>
    Ngày :{{ $book->pivot->borrow_day}} đến {{ $book->pivot->pay_day}} <br>
    Bạn đã quá thời hạn trả sách.
</body>
</html>