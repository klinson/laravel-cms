<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Input;

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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('sort', '排序')->sortable()->editable('text');
            $grid->column('title', '文章标题');
            $grid->column('thumbnail', '缩略图')->display(function ($value) {
                if (substr($value, 0, 4) === 'http') {
                    return "<img style='width: 100px' src='".$value."'>";
                }
                return "<img style='width: 100px' src='".\Storage::url($value)."'>";
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

            $grid->column('publish_time', '发布时间')->sortable();
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
    protected function form($id = 0)
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->tab('基本信息', function (Form $form) {
                $form->text('title', '标题')->rules('required');
                $form->editor('content', '内容')->rules('required');
                $form->textarea('description', '描述');
                $form->image('thumbnail', '封面');
            })->tab('发布信息', function (Form $form) {
                $form->text('author', '作者');
                $form->datetime('publish_time', '发布时间')->format('YYYY-MM-DD HH:mm:ss');
            })->tab('设置', function (Form $form) {
                $form->number('sort', '排序')->default(0);
                $form->switch('is_top', '是否置顶')->default(0);
                $form->switch('has_enabled', '状态')->default(1);
                $form->number('pv', '阅读量')->default(0);
            });

            $form->saving(function (Form $form) {

            });
        });
    }

    public function update($id)
    {
        $data = Input::all();
        if (isset($data['has_enabled'])) {
            $data['has_enabled'] = ($data['has_enabled'] === 'on') ? 1 : 0;
        }
        if (isset($data['is_top'])) {
            $data['is_top'] = ($data['is_top'] === 'on') ? 1 : 0;
        }
        return $this->form()->update($id, $data);
    }

}
