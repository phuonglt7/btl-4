@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<h3> QUẢN LÝ Tài Khoản</h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Tạo mới sách
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    @include('users.add')
</div>

<table class="table table-bordered data-table">
   <thead>
    <th>STT</th>
    <th>Tài khoản</th>
    <th> Email </th>
    <th> Họ tên </th>
    <th width="200px">Action</th>

</thead>
<tbody>
    @foreach($view as $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $i ++}}</td>
        <td> {{ $item->username }} </td>
        <td> {{ $item->email }} </td>
        <td> {{ $item->fullname }} </td>
        <td>
            <div class = "d-flex">
                <form action="{{route('user.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
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

@endsection
