<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/11/28
 * Time: 21:38
 */

namespace App\Admin\Controllers\Wechat;

use App\Admin\Controllers\Controller;
use App\Admin\Extensions\Actions\GetButton;
use App\Models\WechatMessage;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MessagesController extends Controller
{
    public function index()
    {
        $this->pageHeader = '微信公众号 - 消息管理';
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(WechatMessage::class, function (Grid $grid) {
            $grid->model()->recent();

            $grid->column('id', 'ID')->sortable();
            $grid->column('user_info_avatar', '用户头像')->display(function ($item) {
                return <<<HTML
<img src="{$this->from_user_info->headimgurl}" />
HTML;
            });
            $grid->column('user_info', '用户基本信息')->display(function ($item) {
                $sex = WECHAT_USER_SEX[$this->from_user_info->sex];
                return <<<HTML
{$this->from_user_info->nickname} | {$sex} <br/>
{$this->from_user_info->country} {$this->from_user_info->province} {$this->from_user_info->city} 
HTML;
            });

            $grid->column('type', '消息类型')->display(function ($item) {
                return WechatMessage::TYPE_TITLE[$item] ?? '其他';
            });
            $grid->column('content', '消息内容');
            $grid->column('received_at', '留言时间')->sortable();

            $grid->filter(function ($filter) {

            });

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableEdit();
                $actions->disableView();
                $actions->append(new GetButton(
                    $actions->getResource() . '/' . $actions->getKey(),
                    '回复',
                    '_self',
                    'success'
                ));
            });
        });
    }

    public function reply(WechatMessage $message)
    {

    }

    public function destroy(WechatMessage $message)
    {
        if ($message->delete()) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status' => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }
}