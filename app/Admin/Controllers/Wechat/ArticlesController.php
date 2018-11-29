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
use App\Admin\Extensions\Actions\GetButton;
use App\Models\Article;
use App\Models\WechatArticle;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

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
            $grid->model()->with(['article']);

            $grid->column('id', 'ID')->sortable();
            $grid->article()->title('文章标题');
            $grid->article()->thumbnail('缩略图')->image();

            $grid->column('wechat_media_id', '微信资源id');
            $grid->column('published_at', '发布时间')->sortable();
            $grid->column('created_at', '创建时间')->sortable();

            $grid->filter(function ($filter) {

            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableEdit();
                $actions->disableView();
                $actions->append(new AjaxButton(
                    $actions->getResource() . '/' . $actions->getKey() . '/publish',
                    '微信群发',
                    'primary'
                ));
                $actions->append(new GetButton(
                    $actions->getResource() . '/' . $actions->getKey(),
                    '预览',
                    '_blank',
                    'primary'
                ));
            });
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
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(WechatArticle::class, function (Form $form) {
            $articles = Article::selectOptions();
            $form->select('article_id', '文章')->options($articles);
        });
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'article_id' => ['required', 'exists:articles,id'],
        ], [
            'article_id' => '文章',
        ]);
        try {
            $article = Article::find($request->article_id);
            if (empty($article)) {
                throw new \Exception('找不到文章');
            }
            $wechatArticle = new WechatArticle();
            $wechatArticle->article_id = $request->article_id;
            $wechatArticle->wechat_media_id = $article->uploadToWechatServer();
            $wechatArticle->save();

            admin_toastr('保存成功', 'success');
            return redirect('/admin/wechat/articles');
        } catch (\Exception $exception) {
            admin_toastr($exception->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }

    public function publish(WechatArticle $article)
    {
        try {
            $article->publish();
            $data = [
                'status'  => true,
                'message' => trans('群发成功'),
            ];
        } catch (\Exception $exception) {
            $data = [
                'status'  => false,
                'message' => trans($exception->getMessage()),
            ];
        }
        return response()->json($data);
    }

    public function show(WechatArticle $article)
    {
        try {
            $info = $article->getWechatMediaInfo();
            header('Location: ' . $info['url']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(WechatArticle $article)
    {
        if ($article->delete()) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status' => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }
}