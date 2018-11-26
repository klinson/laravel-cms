<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-9
 * Time: 下午5:39
 */

namespace App\Admin\Controllers;


use App\Models\Category;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class WechatController extends Controller
{
    public function menus()
    {
        $this->pageHeader = '微信公众号 - 菜单设置';

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

    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

                return $payload;
            });
        });
    }

    protected function iconHelp()
    {
        return 'aaaaaaaaaaaaaaasad';
    }

}