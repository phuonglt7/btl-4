@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2">
            <ul class="nav nav-pills flex-column nav-justified">
                <li class="nav-item bg-info">
                    <a class="nav-link text-white disabled" href="#">Logo</a>
                </li>
                <li class="nav-item bg-info text-white">
                    <a class="nav-link text-white active" href="#">Sách</a>
                </li>
                <li class="nav-item bg-info text-white">
                    <a class="nav-link text-white" href="#">Tác giả</a>
                </li>
                <li class="nav-item bg-info text-white">
                    <a class="nav-link text-white" href="#">Tài khoản</a>
                </li>
                <li class="nav-item bg-info text-white">
                    <a class="nav-link text-white" href="#">Thùng Rác</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9">
            @yield('execute')
        </div>
    </div>
</div>
@endsection