<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class MessagesController extends Controller
{
    use ModelForm;

    protected $pageHeader = '联系我们管理';

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);

            $content->body($this->grid());
        });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Message::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();

            $grid->column('name', '联系人');
            $grid->column('email', '邮箱');
            $grid->column('subject', '主题');
            $grid->column('content', '内容');
            $grid->column('created_at', '提交时间')->sortable();
            $grid->column('ip', 'ip');

            $grid->filter(function ($filter) {
                $filter->like('name', '联系人');
                $filter->like('email', '邮箱');
                $filter->like('subject', '主题');
                $filter->like('content', '内容');
                $filter->between('created_at', '提交时间');
            });

            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }
}
