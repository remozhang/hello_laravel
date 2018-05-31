<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // 由于show()方法传参时声明了类型——Eloquent模型User
    // 对应变量名$user会匹配路由片段中的{user}
    // 这样 Laravel会自动注入与请求URI中传入的ID对应的用户模型实例
    // 称为“隐性模型绑定”
    public function show(User $user)
    {
        // 这里compact方法将user作为一个关联数组，数组中包含$user类对象
        // 然后将user传入到视同中 作为一个关联数组传递
        return View('users.show', compact('user'));
    }
}
