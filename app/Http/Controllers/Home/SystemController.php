<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-10-31
 * Time: 下午6:29
 */

namespace App\Http\Controllers\Home;

use App\Models\Message;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function contactUs()
    {
        return $this->view();
    }

    public function storeContactUs(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:1', 'max:50'],
            'email' => ['required', 'email', 'min:1', 'max:250'],
            'subject' => ['required', 'min:1', 'max:50'],
            'content' => ['required', 'min:1', 'max:250'],
            'captcha' => ['required', 'captcha']
        ], [
            'captcha.required' => '验证码必须',
            'captcha.captcha' => '验证码错误',
        ], [
            'name' => '姓名1',
            'email' => '邮箱',
            'subject' => '主题',
            'content' => '内容',
            'captcha' => '验证码',
        ]);

        $message = new Message($request->all());
        $message->ip = $request->getClientIp();
        $message->save();

        $request->session()->flash('success', '提交成功');
        return redirect(route('system.contactUs'));
    }
}