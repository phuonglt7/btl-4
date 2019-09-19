@extends('layouts.app')

@section('execute')
<div class="float-right" s>
    @include('layouts.announce')
</div>
<div class="float-right alert">
</div>
<h3> QUẢN LÝ TÁC GIẢ </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#myModal">
  Tạo mới tác giả
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    @include('authors.add')
</div>
<br/>
<div id ="author">
@include('authors.table')
</div>
@include('authors.edit')
@endsection
