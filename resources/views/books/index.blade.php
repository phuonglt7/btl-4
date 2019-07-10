@extends('layouts.app')

@section('execute')
<h3> QUẢN LÝ TÁC GIẢ </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Tạo mới tác giả
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    @include('authors.add')
</div>
@include('layouts.announce')
<br/>
<ul class="nav nav-tabs float-right">
    <li class="nav-item">
        <a class="nav-link active" href="">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('') }}">Đã mượn</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">Chưa mượn</a>
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
    <tr data-id="{{ $item->id }}" data-name="{{ $item->author_name }}" >
        <td> {{ $i ++}}</td>
        <td> {{ $item->book_name }} </td>
        <td>
            <div class = "d-flex">
                <button class='btn btn-info btn-xs btn-edit'>Edit</button>
                <form action="{{route('author.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-xs btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach

</tbody>

</table>
@endsection
