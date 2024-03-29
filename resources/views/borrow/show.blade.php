@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>

<h3> MƯỢN SÁCH </h3>
<br>
<table width="400px">
    <tr>
        <td>Tên sách:</td>
        <td> {{ $view->book_name }} </td>
    </tr>
    <tr>
        <td>Tác giả:</td>
        @foreach($authorList as $author)
        @if ($author->id == $view->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach
    </tr>
    <tr>
        <td>
            <a href="{{ route('borrow.edit', $view->id) }}">
                <button class='btn btn-info btn-edit mr-4 ml-4'>MƯỢN SÁCH</button>
            </a>
        </td>
        <td> </td>
        <td>
        </td>
    </tr>
</table>
@endsection
