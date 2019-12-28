<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class CategoriesController extends Controller
{
    use ModelForm;
    protected $pageHeader = '分类管理';

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);
            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('categories'));

                    $form->select('parent_id', '上级分类')->options(Category::selectOptions());
                    $form->text('title', '分类标题')->rules('required');
                    $form->select('is_page', '分类类型')->default(0)->options(['列表分类', '单页分类'])->rules('required|in:0,1');
                    $form->icon('icon', '分类icon')->default('fa-bars')->rules('required')->help($this->iconHelp());
                    $form->image('thumbnail', '缩略图')->uniqueName()->removable();
                    $form->switch('is_top', '是否置顶')->default(0)->rules('required');
                    $form->switch('has_enabled', '是否启用')->default(1)->rules('required');

                    $form->textarea('description', '描述');
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });


//            $content->body(Category::tree());
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
        return redirect()->route('categories.edit', ['id' => $id]);
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
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', trans('admin.title'))->rules('required');

            $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
            $form->select('is_page', '分类类型')->default(0)->options(['列表分类', '单页分类'])->rules('required|in:0,1');
            $form->icon('icon', '分类icon')->default('fa-bars')->rules('required')->help($this->iconHelp());
            $form->image('thumbnail', '缩略图')->uniqueName()->removable();
            $form->switch('is_top', '是否置顶')->default(0);
            $form->switch('has_enabled', '是否启用')->default(0);

            $form->textarea('description', '描述');
        });
    }

    protected function treeView()
    {
        Admin::script(
            <<<HTML
(new Clipboard('.clipboard-url-btn')).on('success', function(e) {
    alert('复制url['+e.text+']成功');

    e.clearSelection();
});
HTML
        );
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";
                $payload .= "<span class='pull-right dd-nodrag'><a class='clipboard-url-btn' data-clipboard-text='{$branch['web_url']}' href='javascript:void(0);' style='margin-left: 3px'><i class='fa fa-clipboard'></i></a></span>";

                return $payload;
            });
        });
    }

    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }
}
