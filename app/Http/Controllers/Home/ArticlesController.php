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
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('categories')
//            ->withCount('collects')
//            ->withCount('comments')
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
        $categories = Category::top(5);

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

    public function show(Category $category, Article $article)
    {
        return $this->view()->with(compact(['article', 'category']));
    }
}