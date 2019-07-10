<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->permission == 1)
        {
            return $next($request);
        } else {
            return redirect(route('login'))->with('error', 'Bạn không có quyền đăng nhập');
        }
    }
}
