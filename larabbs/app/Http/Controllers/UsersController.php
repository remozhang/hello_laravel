<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    // middleware 接收2个参数 1.中间件名称 2.要进行过滤的动作，
    // 通过except方法来设定指定动作不使用Auth中间件进行过滤
    public function __construct() {
        $this->middleware('auth', ['except' => ['show']]);
    }

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

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return View('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);

//        dd($request->avatar);
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatar', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        // 如果表单验证通过，就更新内容，最后跳转到个人页面，并附带成功的消息提醒
        // 这里后半段指的是将“个人资料更新成功”赋值给变量success
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功!');

    }


}
