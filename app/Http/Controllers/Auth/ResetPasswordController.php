<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * 使用 guest 中间件
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected string $redirectTo = '/';

    /**
     * 重写 ResetsPasswords 类中的 sendResetResponse 方法
     * 在重设密码成功之后携带 flash message 跳转到首页
     *
     * @param Request $request
     * @param $response
     * @return RedirectResponse
     */
    protected function sendResetResponse(Request $request, $response): RedirectResponse
    {
        session()->flash('success', 'Your password has been reset.');
        return redirect($this->redirectPath());
    }
}
