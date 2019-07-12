@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>

<h3> TRẢ SÁCH </h3>
<div class = "ml-5">
    <table width="400px">
        @foreach($view as $user)
        <tr>
            <td>Thời gian mượn :</td>
            <td> {{ $user->pivot->borrow_day }}  </td>
        </tr>
        <tr>
            <td>Thời gian hẹn trả:</td>
            <td>  {{ $user->pivot->pay_day }} </td>
        </tr>
        <tr>
            <td> Tên sách </td>
            @foreach ($book as $item)
            @if ($item->id == $user->pivot->book_id)
            <td> {{ $item->book_name }} </td>
            @endif
            @endforeach
        </tr>
        <tr>
            <td>
                 <form action="{{route('pay.pay-book') }}" class="submitDelete" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="book_id" value="{{ $user->id }}">
                    <button type="submit" class="btn btn-info btn-edit mr-4 ml-4">Trả sách</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
