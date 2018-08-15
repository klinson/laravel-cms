<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Rules\CnMobile;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use ModelForm;
    protected $pageHeader = '用户管理';

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
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $this->_setPageDefault($content);

            $content->body(Admin::show(User::findOrFail($id), function (Show $show) {

                $fields = [
                    'id' => 'ID',
                    'username' => '用户名',
                    'nickname' => '昵称',
                    'name' => '姓名',
                    'email' => '邮箱',
                    'mobile' => '联系方式',
                ];
                $show->fields($fields);

                $show->field('sex', '性别')->using(['女', '男']);
                $show->field('has_enabled', '状态')->using(['禁用', '启用']);
                $show->field('created_at', '注册时间');

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
            $this->_setPageDefault($content);

            $content->body($this->form($id)->edit($id));
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
            $this->_setPageDefault($content);

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
    protected function form($id = 0)
    {
        return Admin::form(User::class, function (Form $form) use ($id) {
            $form->model()->makeVisible('password');
            if ($id) {
                $form->display('id', 'ID');
                $form->display('username', '用户名');
            } else {
                $form->text('username', '用户名')->rules('required|unique:users,username,0,id,deleted_at,NULL');
//                $form->text('username', '用户名')->rules(function ($form) {
//                    // 如果不是编辑状态，则添加字段唯一验证
//                    if (!$id = $form->model()->id) {
//                        return 'required|unique:users,username,0,id,deleted_at,NULL';
//                    } else {
//                        return 'required|unique:users,username,'.$id.',id,deleted_at,NULL';
//                    }
//                });
            }

            $form->tab('基本信息', function (Form $form) {
                $form->text('name', '姓名')->rules('required');
                $form->text('nickname', '昵称')->default('');

                $form->select('sex', '性别')->options([
                    '女', '男',
                ])->default(1)->rules('required');

                $form->text('email', '邮箱')->rules('nullable|email');
                $form->text('mobile', '联系方式')->rules(['nullable', new CnMobile()]);

                $form->switch('has_enabled', '状态')->default(1);
            })->tab('修改密码', function (Form $form) {
                $form->password('password', '密码')->rules(function ($form) {
                    if ($form->model()->id) {
                        return 'confirmed';
                    } else {
                        return 'required|confirmed';
                    }
                });
                $form->password('password_confirmation', '确认密码');
                $form->ignore(['password_confirmation']);
            });

            $form->saving(function (Form $form) {
                if ($form->input('password')) {
                    $form->input('password', bcrypt($form->password));
                }
            });
        });
    }
}
