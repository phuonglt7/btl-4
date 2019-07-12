@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert alert-success" >
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

@yield('content-book')
@endsection