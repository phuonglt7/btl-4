@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert alert-success" >
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

<table class="table table-bordered data-table">
    <thead>
        <th>STT</th>
        <th>Author</th>
        <th width="200px">Action</th>

    </thead>

    <tbody>
        @foreach($view as $item)
        <tr data-id="{{ $item->id }}" data-name="{{ $item->author_name }}" >
            <td> {{ $i ++}}</td>
            <td> {{ $item->author_name }} </td>
            <td>
                <div class = "d-flex">
                    <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                    <form action="{{route('author.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
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

@include('authors.edit')
@endsection
