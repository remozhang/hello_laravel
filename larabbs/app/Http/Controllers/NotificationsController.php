<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    // 构造方法必须要求登陆以后才能访问控制器的所有方法
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 获取登陆用户所有通知
        $notifications = Auth::user()->notifications()->paginate(20);

        Auth::user()->markAsRead();

        return view('notifications.index', compact('notifications'));
    }

}
