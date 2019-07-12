<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'borrow.index') ? 'active' : '' }}" href="{{ route('borrow.index') }}">Mượn Sách</a>
</li>
<li class="nav-item bg-info text-white">
    <a class="nav-link text-white {{ (\Request::route()->getName() == 'pay.index') ? 'active' : '' }}" href="{{ route('pay.index') }}">Trả Sách</a>
</li>
