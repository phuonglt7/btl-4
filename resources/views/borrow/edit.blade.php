@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>

<h3> MƯỢN SÁCH </h3>
<div class="col-md-3 border border-warning p-2"><a href="{{ route('borrow.index') }}" class ="p-2"> Sách </a> >>  Mượn Sách</div>
<div class = "m-5 ">
    <form action ="{{ route('borrow.store') }}" method="post">
        @csrf
        <table width="400px">
            <tr>
                <td><input type="hidden" name="user_id" value="{{ Auth::id() }}"></td>
                <td><input type="hidden" name="book_id" value="{{ $view->id }}"></td>
            </tr>
            <tr>
                <td>Tên sách: </td>
                <td> {{ $view->book_name }} </td>
            </tr>
            <tr>
                <td>Tác giả: </td>
                @foreach($authorList as $author)
                @if ($author->id == $view->author_id)
                <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
                @endif
                @endforeach
            </tr>
            <tr>
                <td> Ngày mượn: </td>
                <td><input type="text" name="borrow_day" value = "{{ date('Y/m/d') }}" ></td>
            </tr>
            <tr>
                <td> Ngày trả: </td>
                <td><input type="date" name="pay_day" > </td>
            </tr>
            <tr>
                <td></td>
                <td> </td>
                <td>
                    <button class='btn btn-info btn-edit mr-4 ml-4'>Mượn</button>
                    <button class='btn btn-info btn-edit mr-4 ml-4'>Hủy</button>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection
