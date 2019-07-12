<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'book.index') ? 'active' : '' }}" href="{{ route('book.index') }}">Sách</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'author.index') ? 'active' : '' }}" href="{{ route('author.index') }}">Tác giả</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">Tài khoản</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'trash-author') ? 'active' : '' }}" href="{{ route('trash-author') }}">Thùng Rác</a>
</li>