<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 19-3-29
 * Time: 下午3:49
 */

namespace App\Admin\Controllers;


use App\Handlers\HarassMobileHandler;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

class HarassMobileController extends Controller
{
    protected $pageHeader = '手机骚扰攻击';

    public function index()
    {
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);
            $content->row(function (Row $row)  {
                $row->column(12, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->disablePjax();
                    $form->disableReset();

                    $form->textarea('mobiles', '手机号')->placeholder(' ');

                    $form->checkbox('modes', '攻击方式')->options(HarassMobileHandler::modes);

                    $column->append((new Box('测试加密', $form))->style('success'));
                });
            });
        });
    }


    public function harassMobile(Request $request)
    {
        $mobiles = array_values(array_flip(array_flip(array_filter(preg_split("/[\n\r\t,， |\\/]/", $request->mobiles)))));
        $modes = array_values(array_flip(array_flip(array_filter($request->modes))));

        $result = [];
        foreach ($mobiles as $mobile) {
            $res = HarassMobileHandler::getInstance()->handle($mobile, $modes);
            $message = '手机号' . $mobile . '攻击结果: ';
            foreach ($res as $r) {
                $message .= (HarassMobileHandler::modes[$r['mode']] ?? '未知攻击') . ': ' . ($r['res'] ? '√' : 'X') . '  ';
            }
            $result[] = $message;
        }

        admin_info('攻击结果', implode('<br>', $result));
        return redirect()->back();
    }
}