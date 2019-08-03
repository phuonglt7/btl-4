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
        <a class="nav-link {{ (\Request::route()->getName() == 'book.index') ? 'active' : '' }}" href="{{ route('book.page') }}">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ strpos(\Request::url(), 'book/1') ? 'active' : '' }}" href="{{ route('book.show', CHUA_MUON_SACH) }}">Chưa mượn</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ strpos(\Request::url(),'book/2') ? 'active' : '' }}" href="{{ route('book.show', DANG_XEM_SACH) }}">Đang xem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ strpos(\Request::url(), 'book/3') ? 'active' : '' }}" href="{{ route('book.show', DA_MUON_SACH) }}">Đã mượn</a>
    </li>
</ul>
@include('books.index')
@include('books.ajax')

@endsection