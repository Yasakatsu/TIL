<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // roleがadminの場合は次のリクエストを実行
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
