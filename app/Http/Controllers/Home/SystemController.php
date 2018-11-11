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
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    public function contactUs()
    {
        return $this->view();
    }

    public function storeContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            $request->session()->flash('error', '提交失败');
            if ($error_uri = $request->get('error_uri', null)) {
                return redirect($error_uri)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $message = new Message($request->all());
        $message->ip = $request->getClientIp();
        $message->save();

        $request->session()->flash('success', '提交成功');
        if ($success_uri = $request->get('success_uri', null)) {
            return redirect($success_uri);
        } else {
            return redirect()->back();
        }
    }
}