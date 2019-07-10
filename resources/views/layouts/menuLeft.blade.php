<div class="row">
    <div class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item bg-info">
                <a class="nav-link text-white disabled" href="#">Logo</a>
            </li>
            <li class="nav-item bg-info text-white">
                <a class="nav-link text-white active" href="{{ route('book.index') }}">Sách</a>
            </li>
            <li class="nav-item bg-info text-white">
                <a class="nav-link text-white" href="{{ route('author.index') }}">Tác giả</a>
            </li>
            <li class="nav-item bg-info text-white">
                <a class="nav-link text-white" href="#">Tài khoản</a>
            </li>
            <li class="nav-item bg-info text-white">
                <a class="nav-link text-white" href="{{ route('trash-author') }}">Thùng Rác</a>
            </li>
        </ul>
    </div>
    <div class="col-sm-9">
        @yield('execute')
    </div>
</div>