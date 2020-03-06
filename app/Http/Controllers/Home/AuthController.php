<?php
namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function login()
    {
        return $this->view();
    }

    public function storeLogin(Request $request)
    {
        $params = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
        if (Auth::attempt($params)) {
            $request->session()->regenerate();
            return redirect()->route('user');
        } else {
            $request->session()->flash('_message', '账号或密码错误');
            return back()->withInput();
        }
    }

    public function register()
    {
        return $this->view();
    }

    public function storeRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'nickname' => 'required',
            'password' => 'required|confirmed',
            'sex' => 'required',
            'password_confirmation' => 'required'
        ], [], [
            'username' => '用户名',
            'name' => '姓名',
            'nickname' => '昵称',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'sex' => '性别',
        ]);

        $user = new User($request->only(['username', 'name', 'nickname', 'sex']));
        $user->password = bcrypt($request->password);
        $user->save();

        \Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('user');
    }
}