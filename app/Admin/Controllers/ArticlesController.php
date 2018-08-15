<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticlesController extends Controller
{
    use ModelForm;

    protected $pageHeader = '文章管理';

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

            $content->body(Admin::show(Article::findOrFail($id), function (Show $show) {

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
            $this->_setPageDefault($content);

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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('sort', '排序')->sortable()->editable('text');
            $grid->column('title', '文章标题');
            $grid->column('thumbnail', '缩略图')->display(function ($value) {
                return "<img style='width: 100px' src='{$value}'>";
            });

            $states = [
                'on'  => ['value' => 1, 'text' => '置顶', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];
            $grid->column('is_top', '置顶?')->switch($states);

            $states = [
                'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
            ];
            $grid->column('has_enabled', '状态?')->switch($states);

            $grid->column('publish_time', '发布时间')->display(function ($data) {
                return date('Y-m-d H:i:s', $data);
            })->sortable();
            $grid->column('created_at', '创建时间')->display(function ($data) {
                return date('Y-m-d H:i:s', $data);
            })->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }


}
