@extends('books.layouts')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert alert-success">
</div>

<h3> QUẢN LÝ SÁCH </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Tạo mới sách
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    @include('books.add')
</div>


<ul class="nav nav-tabs float-right">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('book.index') }}">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('book.show',1) }}">Chưa mượn</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('book.show',2) }}">Đang xem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('book.show',3) }}">Đã mượn</a>
    </li>
</ul>
<table class="table table-bordered data-table">
 <thead>
    <th>STT</th>
    <th>Tên sách</th>
    <th> Tác giả </th>
    <th> Trạng thái </th>
    <th> Người mượn </th>
    <th width="200px">Action</th>

</thead>
<tbody>
    @foreach($view as $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $i ++}}</td>
        <td> {{ $item->book_name }} </td>
        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach

        @if ($item->book_status == 1)
        <td> Chưa mượn </td>
        @elseif($item->book_status == 2)
        <td> Đang xem </td>
        @elseif ($item->book_status == 3)
        <td> Đã mượn </td>
        @endif
        <td> </td>
        <td>
            <div class = "d-flex">
                <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                <form action="{{route('book.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}
@include('books.edit')

@endsection
