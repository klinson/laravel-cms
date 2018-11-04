<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
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
                $show->id('id');
                $show->title('标题');
                $show->categories('分类')->as(function ($value) {
                    $style = 'success';

                    return $value->map(function ($category) use ($style) {
                        return "<span class='label label-{$style}'>{$category['title']}</span>";
                    })->implode('&nbsp;');
                });

                show_images($show, 'thumbnail', '缩略图');
                $show->description('描述');
                $show->content('内容');
                $show->is_top('是否置顶')->as(function ($v) {
                    return $v ? '是' : '否';
                });
                $show->has_enabled('状态')->as(function ($v) {
                    return $v ? '正常' : '禁用';
                });
                $show->author('作者');
                $show->publish_time('发布时间');
                $show->created_at('创建时间');
                $show->updated_at('更新时间');
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
            $grid->categories('所属分类')->pluck('title')->label();
            $grid->column('thumbnail', '缩略图')->image();

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

            $grid->filter(function ($filter) {
                $filter->like('title', '文章标题');
//                $filter->in('categories', '所属分类')->multipleSelect(Category::selectCategoryOptions());

                $filter->where(function ($query) {
                    $query->whereHas('categories', function ($query) {
                        $query->whereIn('id', $this->input);
                    });
                }, '所属分类')->multipleSelect(Category::selectCategoryOptions());

                $filter->between('publish_time', '发布时间')->datetime();

                $filter->equal('is_top', '置顶')->radio([
                    ''   => '所有',
                    0    => '未置顶',
                    1    => '已置顶',
                ]);

                $filter->equal('has_enabled', '状态')->radio([
                    ''   => '所有',
                    0    => '禁用',
                    1    => '正常',
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
        return Admin::form(Article::class, function (Form $form) {

            $form->tab('基本信息', function (Form $form) {
                $form->text('title', '标题')->rules('required');
                $form->multipleSelect('categories', '所属分类')->options(Category::selectCategoryOptions());
                $form->editor('content', '内容')->rules('required');
                $form->textarea('description', '描述');
                $form->image('thumbnail', '封面')->uniqueName()->removable();
            })->tab('发布信息', function (Form $form) {
                $form->text('author', '作者');
                $form->datetime('publish_time', '发布时间')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
            })->tab('设置', function (Form $form) {
                $form->number('sort', '排序')->default(0);
                $form->switch('is_top', '是否置顶')->default(0);
                $form->switch('has_enabled', '状态')->default(1);
                $form->number('pv', '阅读量')->default(0);
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
