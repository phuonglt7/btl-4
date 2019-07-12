<div class="row">
    <div class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item bg-info">
                <a class="" href="#">Logo</a>
            </li>
            @if (Auth::user()->permission == 1)
            @include('layouts.admin.menu')
            @else
            @include('layouts.customer.menu')
            @endif
        </ul>
    </div>
    <div class="col-sm-9">
        @yield('execute')
    </div>
</div>