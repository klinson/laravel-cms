<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-9
 * Time: 下午5:39
 */

namespace App\Admin\Controllers\Wechat;


use App\Admin\Controllers\Controller;
use App\Models\WechatMenu;
use App\Rules\CheckWechatMenu;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    use HasResourceActions;

    public function index()
    {
        $this->pageHeader = '微信公众号 - 菜单设置';

        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);
            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('wechat/menus'));

                    $form->select('parent_id', '上级菜单')->options(WechatMenu::menus())->help($this->help('menus'));
                    $form->text('name', '菜单标题')->rules('required');
                    $form->select('type', '菜单类型')->options(WechatMenu::menu_options)->rules('required|in:'.implode(',', WechatMenu::menu_types))->default('view')->help($this->help());

                    $form->text('value', '菜单值')->help($this->help('value'));
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
        });
    }

    public function store(Request $request)
    {
        if ($request->_order) {
            $orders = json_decode($request->_order, true);
            if (count($orders) > 3) {
                admin_toastr('顶级菜单最多只能3个', 'error');
                return response()->json([
                    'status'  => false,
                    'message' => '顶级菜单最多只能3个',
                ]);
            }
            $number = 0;
            foreach ($orders as $order) {
                $number++;
                if (isset($order['children'])) {
                    $count = count($order['children']);
                    if ($count > 3) {
                        admin_toastr('子菜单最多只能3个', 'error');
                        return response()->json([
                            'status'  => false,
                            'message' => '子菜单最多只能3个',
                        ]);
                    } else {
                        $number += $count;
                    }
                }
            }
            $list = tree_to_list($orders, 'id', 'children');
            if (count($list) !== $number) {
                admin_toastr('最多只能2级菜单', 'error');
                return response()->json([
                    'status'  => false,
                    'message' => '子菜单最多只能3个',
                ]);
            }

            $this->form()->store();
        } else {
            $this->validate($request, [
                'parent_id' => ['required', new CheckWechatMenu()],
                'type' => ['required', 'in:'.implode(',', WechatMenu::menu_types)],
                'name' => ['required', 'max:16'],
                'value' => ['required_unless:type,menus', 'max:128'],
            ], [
                'parent_id' => '上级菜单',
                'type' => '菜单类型',
                'name' => '菜单标题',
                'value' => '菜单值'
            ]);
            $wechatMenu = new WechatMenu();
            $wechatMenu->fill($request->all());
            $wechatMenu->save();

            return redirect()->back();
        }
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $this->_setPageDefault($content);

            $content->body($this->form()->edit($id));
        });
    }

    protected function form()
    {
        return Admin::form(WechatMenu::class, function (Form $form) {
            $form->text('name', '菜单标题')->rules('required,max:16');
            $form->display('type', '菜单类型')->options(WechatMenu::menu_options)->rules('required|in:'.implode(',', WechatMenu::menu_types))->default('view')->help($this->help());
            $form->text('value', '菜单值')->rules('max:128')->help($this->help('value'));
        });
    }

    protected function treeView()
    {
        $map = [
            'click' => 'fa-hand-pointer-o',
            'view' => 'fa-link',
            'menus' => 'fa-align-justify'
        ];
        return WechatMenu::tree(function (Tree $tree) use ($map) {
            $tree->disableCreate();

            $tree->branch(function ($branch) use ($map) {
                $payload = "<i class='fa {$map[$branch['type']]}'></i>&nbsp;&nbsp;<strong>{$branch['name']}</strong>";

                return $payload;
            });
        });
    }

    protected function help($type = 'help')
    {
        switch ($type) {
            case 'value':
                $help = <<<HTML
<ul style="display: inline-grid;">
<li>网页类型：跳转url连接</li>
<li>点击类型：菜单KEY值</li>
<li>子菜单类型：保留空</li>
</ul>
HTML;
                break;
            case 'menus':
                $help = '一级菜单最多3个，二级菜单最多5个';
                break;
            default:
                $help = '详情 <a href="https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141013" target="_blank">微信菜单配置</a>';
                break;
        }
        return $help;
    }

}