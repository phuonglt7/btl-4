@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<h3> QUẢN LÝ Tài Khoản</h3>
<table class="table table-bordered data-table">
   <thead>
    <th>STT</th>
    <th>Tài khoản</th>
    <th> Email </th>
    <th> Họ tên </th>
</thead>
<tbody>
    @foreach($view as $key => $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->username }} </td>
        <td> {{ $item->email }} </td>
        <td> {{ $item->fullname }} </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}

@endsection
