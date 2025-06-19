<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            // 这里的中间件会在 web 路由组中被使用

            // 注册一个确保用户邮箱已验证的中间件
            \App\Http\Middleware\EnsureEmailIsVerified::class,
            // 记录用户最后活跃时间的中间件
            \App\Http\Middleware\RecordLastActiveTime::class,
        ]);

        // 像这样注册的中间件, 可以在任何我们想要用到该中间件的地方使用
        // 就和我们之前在控制器里面使用 auth、guest 一样
        // $middleware->alias([
        //     'verified' => EnsureEmailIsVerified::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
