@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert">
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
        <a class="nav-link list-book " data-href="{{ route('book.page') }}" data-url="book">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link list-book " data-href="{{ route('list-book-none', CHUA_MUON_SACH) }}" data-url="list-book-none">Chưa mượn</a>
    </li>
    <li class="nav-item">
        <a class="nav-link list-book" data-href="{{ route('list-book-view', DANG_XEM_SACH) }}" data-url="list-book-view">Đang xem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link list-book" data-href="{{ route('list-book-borrow') }}" data-url="list-book-borrow">Đã mượn</a>
    </li>
</ul>
<div id= "book">
@include('books.table')
</div>


@endsection