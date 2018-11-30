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
use App\Models\WechatMessageReply;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

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
<img src="{$this->from_user_info->headimgurl}" style="max-width:200px;max-height:200px" class="img img-thumbnail"/>
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
//            $grid->column('content', '消息内容');
            $grid->column('content_show', '消息内容')->display(function () {
                switch ($this->type) {
                    case 'video':
                        return <<<HTML
<video src="{$this->content}" controls="controls" style="max-width:200px;max-height:200px" preload="metadata" ></video>
HTML;

                        break;
                    case 'voice':
                        return <<<HTML
<audio src="{$this->content}" controls="controls" style="z-index: 100" preload="metadata" ></audio>
HTML;
                        break;
                    case 'image':
                        return <<<HTML
<img src="{$this->content}" style="max-width:200px;max-height:200px" class="img img-thumbnail"/>
HTML;
                        break;
                    case 'text':
                    default:
                        return $this->content;
                        break;
                }
            });
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

    public function storeReply(WechatMessage $message, Request $request)
    {
        $this->validate($request, [
            'content' => ['required', 'min:1', 'max:255']
        ], [], ['content' => '回复内容']);

        $data = [
            'content' => $request->get('content'),
            'from' => $message->to,
            'to' => $message->from,
        ];
        $reply = new WechatMessageReply($data);
        if ($reply->send()) {
            $message->replies()->save($reply);
            admin_toastr('发送成功', 'success');
            return redirect()->back();
        } else {
            admin_toastr('发送失败, '.$reply->sendErrorMessage, 'error');
            return redirect()->back()->withInput();
        }
    }

    public function reply(WechatMessage $message)
    {
        return Admin::content(function (Content $content) use ($message) {
            $this->_setPageDefault($content);
            $content->row(function (Row $row) use ($message) {
                $row->column(6, $this->replyShow($message));

                $row->column(6, function (Column $column) use ($message) {
                    $column->row(function (Row $row_c) {
                        $row_c->column(12, function (Column $column) {
                            $form = new \Encore\Admin\Widgets\Form();
                            $form->method('POST');
                            $form->action(route('wechat.message.reply.store'));

                            $form->textarea('content', '回复内容')->help('互动48小时内回复有效');
                            $form->hidden('_token')->default(csrf_token());

                            $column->append((new Box('回复', $form))->style('success'));
                        });
                    });
                    $column->row(function (Row $row_c) use ($message) {
                        $row_c->column(12, function (Column $column) use ($message) {
                            $column->append(new Box('回复列表', $this->replyList($message)->render()));
                        });
                    });
                });
            });
        });
    }

    protected function replyList($message)
    {
        return Admin::grid(WechatMessageReply::class, function (Grid $grid) use ($message) {
            $grid->disableTools();
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->model()->where('wechat_message_id', $message->id)->recent();

            $grid->column('id', 'ID');
            $grid->column('content', '回复内容');
            $grid->column('sent_at', '回复时间');
        });
    }

    protected function replyShow($message)
    {
        return Admin::show($message, function (Show $show) {
            $show->id('id');
            $show->user_info_avatar('用户头像')->as(function () {
                return $this->from_user_info->headimgurl;
            })->image();
            $show->user_info('用户信息')->as(function () {
                $sex = WECHAT_USER_SEX[$this->from_user_info->sex];
                return "{$this->from_user_info->nickname} | {$sex}";
            });
            $show->user_info_address('用户所在')->as(function () {
                return "{$this->from_user_info->country} {$this->from_user_info->province} {$this->from_user_info->city} ";
            });

            switch ($show->getModel()->type) {
                case 'video':
                    $show->content('消息内容')->unescape()->as(function ($url) {
                        return <<<HTML
<video src="{$url}" controls="controls" style="max-width:200px;max-height:200px" preload="metadata" ></video>
HTML;
                    });
                    break;
                case 'voice':
                    $show->content('消息内容')->unescape()->as(function ($url) {
                        return <<<HTML
<audio src="{$url}" controls="controls" style="z-index: 100" preload="metadata" ></audio>
HTML;
                    });
                    break;
                case 'image':
                    $show->content('消息内容')->image();
                    break;
                case 'text':
                default:
                    $show->content('消息内容');
                    break;
            }
            $show->received_at('收到时间');

            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });;
        });
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