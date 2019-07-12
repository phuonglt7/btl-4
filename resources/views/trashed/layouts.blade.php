@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<h3> QUẢN LÝ SÁCH </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Xóa tất cả
</button>
<!-- The Modal -->
<ul class="nav nav-tabs float-right">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('trash-author') }}">Tác giả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('trash-book') }}">Sách</a>
    </li>
</ul>
<table class="table table-bordered data-table">
 @yield('content-trashed')
</table>
{{ $view->links() }}
@endsection
