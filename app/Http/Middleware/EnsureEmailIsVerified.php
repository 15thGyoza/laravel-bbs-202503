<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 三个判断
        // 1、如果用户已经登录
        // 2、并且还没有验证 Email
        // 3、并且访问的不是 email 验证相关的 URL 或者退出的 URL
        if($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*', 'logout')) {
            // 如果没有验证 Email，就重定向到 email 验证的 URL
            return $request->expectsJson() ? abort('403', 'Your email address is not verified.') : redirect()->route('verification.notice');
        }


        return $next($request);
    }
}
