<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDesa
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'desa') {
            return $next($request);
        }

        abort(403, 'Anda tidak punya akses sebagai Operator Desa.');
    }
}
