<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-9
 * Time: 下午5:39
 */

namespace App\Admin\Controllers;


use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\NestedForm;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class WechatController extends Controller
{
    public function menus()
    {
        $this->pageHeader = '微信小程序 - 城主联系方式';

        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);

            $form = new \Encore\Admin\Widgets\Form();
            $form->action('/admin/contactSetting');
            $form->method();
            $form->hasMany('button', '顶级菜单', function (NestedForm $form) {
                $form->text('name', '菜单名');

                $form->hasMany('sub_button', '下级菜单', function ($form) {
                    $form->text('name', '子菜单名');

                });
            });




            $content->body(new Box('城主联系方式', $form));
        });
    }

}