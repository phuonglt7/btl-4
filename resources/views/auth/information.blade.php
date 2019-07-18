@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert alert-success" >
</div>
<h3> QUẢN LÝ TÀI KHOẢN</h3>

<br/>

<table class="table table-bordered data-table">
    <thead>
        <th>username</th>
        <th>full-name </th>
        <th>email</th>
        <th width="200px">Action</th>

    </thead>

    <tbody>
        <tr data-id="{{ Auth::id() }}">
            <td>{{ $view->username }}</td>
            <td>{{ $view->fullname }} </td>
            <td>{{ $view->email }}</td>
            <td>
                <div class = "d-flex">
                    <button class='btn btn-info btn-edit ml-4 mr-4'>Sửa</button>
                    <form  class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
    </tbody>

</table>
@endsection
