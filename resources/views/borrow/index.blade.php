@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<h3> SÁCH </h3>
<table class="table table-bordered data-table">
 <thead>
    <th>STT</th>
    <th>Tên sách</th>
    <th> Tác giả </th>
    <th width="200px">Action</th>

</thead>
<tbody>
    @foreach($view as $key => $item)
    <tr>
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->book_name }} </td>
        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach
        <td>
            <div class = "d-flex">
                <a href="{{ route('borrow.edit', $item->id) }}">
                    <button class='btn btn-info btn-edit mr-4 ml-4'>Mượn</button>
                </a>
                <a href="{{ route('borrow.show', $item->id) }}">
                <button class='btn btn-info btn-edit mr-4 ml-4'>Xem chi tiết</button>
            </a>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}
@endsection
