<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->permission == 1) {
            return $next($request);
        } else {
            return redirect(route('login'))->with('error', 'Bạn không có quyền đăng nhập');
        }
    }
}
