<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-10-31
 * Time: 下午6:29
 */

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('categories')
            ->withCount('collects')
            ->withCount('comments')
            ->orderBy('is_top', 'desc')
            ->orderBy('sort', 'desc')
            ->where('articles.has_enabled', 1);
        if ($request->q) {
            $query->where('title', '%'.$request->q.'%');
        }
        if ($request->category_id && ($category = Category::find($request->category_id)
    )) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        }

        $articles = $query->paginate();

        $recents = Article::recent(5);
        $categories = Category::topList(5);

        return $this->view()->with(compact('category', 'articles', 'recents', 'categories'));
    }

    public function categories(Category $category)
    {
        if ($category->is_page) {
            $articles = $category->pageArticle;
        } else {
            $articles = $category->articles()->paginate();
        }
        return $this->view()->with(compact(['category', 'articles']));
    }

    public function show(Article $article)
    {
        $article->incPv();
        $recents = Article::recent(5);
        $categories = Category::topList(5);
        $article->load(['icollect']);
        $comments = $article->comments()->with(['user'])->recent()->paginate();
        return $this->view()->with(compact('article', 'recents', 'categories', 'comments'));
    }

    public function collect(Article $article, Request $request)
    {
        if ($request->isMethod('post')) {
            $article->collect(\Auth::user()->id);
            $type = '';
        } else {
            $article->discollect(\Auth::user()->id);
            $type = '取消';
        }

        return response()->json([
            'status' => 1,
            'msg' => $type.'收藏成功',
        ]);
    }

    public function comment(Article $article, Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ], [], [
            'content' => '评论内容'
        ]);

        $article->comments()->create([
            'user_id' => \Auth::user()->id,
            'content' => $request->get('content'),
        ]);

        return response()->json([
            'status' => 1,
            'msg' => '评论成功',
        ]);

    }
}