<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/11/28
 * Time: 21:38
 */

namespace App\Admin\Controllers\Wechat;

use App\Admin\Controllers\Controller;
use App\Admin\Extensions\Actions\AjaxButton;
use App\Models\WechatArticle;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ArticlesController extends Controller
{
    use HasResourceActions;

    public function index()
    {
        $this->pageHeader = '微信公众号 - 图文管理';
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(WechatArticle::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->article()->title('文章标题');
            $grid->article()->thumbnail('缩略图')->image();

            $grid->column('published_at', '发布时间')->sortable();
            $grid->column('created_at', '创建时间')->display(function ($data) {
                return date('Y-m-d H:i:s', $data);
            })->sortable();

            $grid->filter(function ($filter) {

            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableEdit();
                $actions->append(new AjaxButton(
                    $actions->getResource() . '/' . $actions->getKey() . '/publishWechat',
                    '微信群发',
                    'primary'
                ));
            });
        });
    }
}