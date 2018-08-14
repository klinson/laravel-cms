<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户管理');
            $content->description('用户管理');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(User::findOrFail($id), function (Show $show) {

                $show->id();

                $show->created_at();
                $show->updated_at();
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Edit');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Create');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('username', '用户名');
            $grid->column('name', '姓名');
            $grid->column('nickname', '昵称');
            $grid->column('sex', '性别')->display(function ($data) {
                return $data ? '男' : '女';
            });
            $grid->column('email', '邮箱');
            $grid->column('mobile', '联系方式');

            $grid->column('has_enabled', '状态?')->display(function ($data) {
                return $data ? '启用' : '禁用';
            });
            $grid->column('created_at', '注册时间')->display(function ($data) {
                return date('Y-m-d H:i:s', $data);
            });


            $grid->filter(function ($filter) {
                $filter->where(function ($query) {
                    $query->where('username', 'like', "%{$this->input}%")
                        ->orWhere('name', 'like', "%{$this->input}%")
                        ->orWhere('nickname', 'like', "%{$this->input}%")
                        ->orWhere('email', 'like', "%{$this->input}%")
                        ->orWhere('mobile', 'like', "%{$this->input}%");
                }, '用户名/姓名/昵称/邮箱/联系方式');

                $filter->equal('sex', '性别')->radio([
                    ''   => '所有',
                    0    => '女',
                    1    => '男',
                ]);
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');


        });
    }
}
