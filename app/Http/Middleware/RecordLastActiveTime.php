<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordLastActiveTime
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 如果是登录用户的话
        if (auth()->check()) {
            // 记录最后登录时间
            auth()->user()->recordLastActiveAt();
        }

        return $next($request);
    }
}
