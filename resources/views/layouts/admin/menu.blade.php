<li class="nav-item bg-info text-white">
    <a class="nav-link text-dark {{ (\Request::route()->getName() == 'book.page') ? 'active' : '' }}" href="{{ route('book.page') }}">Sách</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-dark {{ (\Request::route()->getName() == 'author.page') ? 'active' : '' }}" href="{{ route('author.page') }}">Tác giả</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-dark {{ (\Request::route()->getName() == 'user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">Tài khoản</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-dark {{ (\Request::route()->getName() == 'trash-author') ? 'active' : '' }}" href="{{ route('trash-author') }}">Thùng Rác</a>
</li>