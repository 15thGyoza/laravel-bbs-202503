<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     *
     * @return View
     */
    public function index(): View
    {
        // 获取当前用户的通知，并进行分页
        $notifications = auth()->user()->notifications()->paginate(20);

        // 标记所有通知为已读
        auth()->user()->markAsRead();

        return view('notifications.index', compact('notifications'));
    }
}
