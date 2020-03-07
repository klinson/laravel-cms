<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        return $this->view();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nickname' => 'required',
//            'password' => 'required',
            'sex' => 'required',
        ], [], [
//            'username' => '用户名',
            'name' => '姓名',
            'nickname' => '昵称',
            'password' => '密码',
            'sex' => '性别',
        ]);

        \Auth::user()->fill($request->only(['name', 'nickname', 'sex']));
        if ($request->password) {
            \Auth::user()->password = bcrypt($request->password);
        }
        \Auth::user()->save();
        $request->session()->flash('_success', '修改成功');
        return redirect()->route('user');
    }

}