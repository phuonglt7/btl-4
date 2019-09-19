@extends('layouts.app')
@section('execute')
<div class="float-right alert">
</div>
<br/>
<h3> QUẢN LÝ SÁCH </h3>
<ul class="nav nav-tabs float-right">
    <li class="nav-item">
        <a class="nav-link list-trashed" data-href="{{ route('trash-author') }}" data-url="trash-author">Tác giả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link list-trashed" data-href="{{ route('trash-book') }}" data-url="trash-book">Sách</a>
    </li>
</ul>
<div id ="table">
    @if($status == "author" )
    @include('trashed.indexAuthor')
    @else
    @include('trashed.indexBook')
    @endif
</div>
 <script src="{{ asset('js/trashPaginate.js') }}"></script>
    @endsection

