<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Actions\GetButton;
use App\Admin\Extensions\Tools\DefaultSimpleTool;
use App\Models\CarouselAd;
use App\Models\CarouselAdItem;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

class CarouselAdsController extends Controller
{
    use ModelForm;

    protected $pageHeader = '轮播广告管理';

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
        return Admin::grid(CarouselAd::class, function (Grid $grid) {

            $grid->model()->withCount('items');
            $grid->column('id', '序号')->sortable();
            $grid->column('title', '轮播主标题')->editable();
            $grid->column('key', 'key')->label();

            $states = [
                'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
            ];
            $grid->column('has_enabled', '状态?')->switch($states);
            $grid->column('items_count', '轮播图数');

            $grid->column('created_at', '创建时间')->sortable();

            $grid->disableExport();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
                $actions->disableEdit();
                $actions->append(new GetButton(
                    $actions->getResource() . '/' . $actions->getKey().'/items',
                    '轮播图管理'
                ));
            });

            $grid->filter(function ($filter) {
                $filter->like('title', '轮播主标题');
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
        return Admin::form(CarouselAd::class, function (Form $form) use ($id) {
            $form->text('title', '主标题')->rules('required');
            if ($id) {
                $form->display('key', 'KEY');
            } else {
                $form->text('key', 'KEY')->rules('required|unique:carousel_ads,key,NULL,id,deleted_at,NULL');
            }
            $form->switch('has_enabled', '状态')->default(1);

            if ($id == 0) {
                $form->hasMany('items', '轮播图', function (Form\NestedForm $form) use ($id) {
                    $form->image('picture', '轮播图')->uniqueName()->rules('required|image');
                    $form->text('item_title', '子标题')->rules('max:250');
                    $form->text('url', '跳转链接')->rules('max:250');
                    $form->number('sort', '排序')->default(0)->rules('required|min:0|integer');
                });
            }

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function items(CarouselAd $ad)
    {
        return Admin::content(function (Content $content) use ($ad) {
            $this->pageHeader .= " [{$ad->key}]{$ad->title}轮播图设置";
            $this->_setPageDefault($content);

            $content->row(function ($row) use ($ad) {
                $row->column(6, $this->adItemsGist($ad));

                $row->column(6, function ($column) use ($ad) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path("carouselAds/{$ad->id}/items"));

                    $form->image('picture', '轮播图')->uniqueName()->rules('required|image');
                    $form->text('item_title', '子标题');
                    $form->text('url', '跳转链接');
                    $form->number('sort', '排序')->default(0)->rules('required|min:0');
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
        });
    }

    public function adItemsGist(CarouselAd $ad)
    {
        return Admin::grid(CarouselAdItem::class, function (Grid $grid) use ($ad) {
            $grid->model()->where('carousel_ad_id', $ad->id)->sort();
            $grid->column('id', '序号')->sortable();
            $grid->column('sort', '排序')->sortable()->editable();
            $grid->column('item_title', '标题')->editable();
            $grid->column('picture', '轮播图')->image();
            $grid->column('url', 'url')->editable();

            $grid->disableExport();
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new DefaultSimpleTool(admin_base_path('carouselAds'), '返回列表', 'right', 'default', 'mail-reply'));
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });
        });
    }

    public function storeItems(CarouselAd $ad, Request $request)
    {
        $this->validate($request, [
            'sort' => ['required', 'min:0', 'integer'],
            'item_title' => ['max:250'],
            'url' => ['max:250'],
            'picture' => ['required', 'image'],
        ], [], [
            'sort' => '排序',
            'item_title' => '标题',
            'picture' => '轮播图',
            'url' => 'url'
        ]);
        $disk = config('admin.upload.disk');
        $res = \Storage::disk($disk)->put('images', $request->picture);
        $data = $request->all();
        $data['picture'] = $res;
        $ad->items()->create($data);

        return redirect()->back();
    }

    public function editItems(CarouselAd $ad, CarouselAdItem $item)
    {
        $this->pageHeader .= " [{$ad->key}]{$ad->title}轮播图设置";

        return Admin::content(function (Content $content) use ($item) {
            $this->_setPageDefault($content);

            $content->body($this->itemForm()->edit($item->id));
        });
    }

    public function itemForm()
    {
        return Admin::form(CarouselAdItem::class, function (Form $form) {
            $form->image('picture', '轮播图')->uniqueName()->rules('required|image');
            $form->text('item_title', '子标题')->rules('max:250');
            $form->text('url', '跳转链接')->rules('max:250');
            $form->number('sort', '排序')->default(0)->rules('required|min:0|integer');

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function updateItems(CarouselAd $ad, CarouselAdItem $item)
    {
        return $this->itemForm()->update($item->id);
    }

    public function destroyItems(CarouselAd $ad, CarouselAdItem $item)
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
