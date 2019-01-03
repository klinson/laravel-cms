<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Actions\GetButton;
use App\Admin\Extensions\Tools\DefaultSimpleTool;
use App\Models\CarouselAd;
use App\Models\CarouselAdItem;
use App\Models\Link;
use App\Models\LinkItem;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    use ModelForm;

    protected $pageHeader = '超链接管理';

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
        return Admin::grid(Link::class, function (Grid $grid) {

            $grid->model()->withCount('items');
            $grid->column('id', '序号')->sortable();
            $grid->column('title', '标题')->editable();
            $grid->column('key', 'key')->label();

            $states = [
                'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
            ];
            $grid->column('has_enabled', '状态?')->switch($states);
            $grid->column('items_count', '链接数');

            $grid->column('created_at', '创建时间')->sortable();

            $grid->disableExport();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
                $actions->disableEdit();
                $actions->append(new GetButton(
                    $actions->getResource() . '/' . $actions->getKey().'/items',
                    '链接管理'
                ));
            });

            $grid->filter(function ($filter) {
                $filter->like('title', '标题');
                $filter->like('key', 'KEY');

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
        return Admin::form(Link::class, function (Form $form) use ($id) {
            $form->text('title', '主标题')->rules('required');
            if ($id) {
                $form->display('key', 'KEY');
            } else {
                $form->text('key', 'KEY')->rules('required|unique:links,key,NULL,id,deleted_at,NULL');
            }
            $form->switch('has_enabled', '状态')->default(1);

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function items(Link $link)
    {
        return Admin::content(function (Content $content) use ($link) {
            $this->pageHeader .= " [{$link->key}]{$link->title}超链接设置";
            $this->_setPageDefault($content);
            $content->row(function ($row) use ($link) {
                $row->column(6, $this->treeView($link)->render());

                $row->column(6, function ($column) use ($link) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(route('links.items.store', ['link' => $link]));
                    $form->method('POST');

                    $form->select('parent_id', '上级链接')
                        ->options($link->selectOptions());
                    $form->text('item_title', '链接标题')
                        ->rules('required');
                    $form->text('url', 'url');
                    $form->select('target', '打开方式')->default('_self')->options([
                        '_self' => '当前窗口打开',
                        '_blank' => '新窗口打开',
                    ])->rules('required');
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
        });
    }

    protected function treeView(Link $link)
    {
        return LinkItem::tree(function (Tree $tree) use ($link) {
            $tree->disableCreate();
            $tree->query(function ($query) use ($link) {
                return $query->where('link_id', $link->id);
            });

            $tree->branch(function ($branch) {
                $payload = "<i class='fa ".($branch['target'] == '_blank' ? 'fa-external-link' : 'fa-link')."'></i>&nbsp;&nbsp;<strong>{$branch['item_title']}&nbsp;&nbsp;{$branch['url']}</strong>";
                return $payload;
            });

            $tree->tools(function (Tree\Tools $tools) {
                $tools->add(new DefaultSimpleTool(admin_base_path('links'), '返回列表', 'right', 'default', 'mail-reply'));
            });
        });
    }

    public function storeItems(Link $link, Request $request)
    {
        if ($request->_order) {
            $this->itemForm()->store();
        } else {
            $this->validate($request, [
                'item_title' => ['required', 'max:250'],
                'url' => ['required', 'max:250'],
                'target' => ['required', 'in:_self,_blank'],
            ], [], [
                'item_title' => '标题',
                'target' => '打开方式',
                'url' => 'url'
            ]);
            $link->items()->create($request->all());

            return redirect()->back();
        }
    }

    public function editItems(Link $link, LinkItem $item)
    {
        $this->pageHeader .= " [{$link->key}]{$link->title}轮播图设置";

        return Admin::content(function (Content $content) use ($item) {
            $this->_setPageDefault($content);

            $content->body($this->itemForm()->edit($item->id));
        });
    }

    public function itemForm()
    {
        return Admin::form(LinkItem::class, function (Form $form) {
            $form->text('item_title', '标题')->rules('max:250');
            $form->text('url', '跳转链接')->rules('max:250');
            $form->select('target', '打开方式')->default('_self')->options([
                '_self' => '当前窗口打开',
                '_blank' => '新窗口打开',
            ])->rules('required');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function updateItems(Link $link, LinkItem $item)
    {
        return $this->itemForm()->update($item->id);
    }

    public function destroyItems(Link $link, LinkItem $item)
    {
        if ($this->itemForm()->destroy($item->id)) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }


    public function update($id)
    {
        return $this->form($id)->update($id);
    }
}
