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

class ArticlesController extends Controller
{
    public function index()
    {
        return $this->view();
    }

    public function categories(Category $category)
    {
        $articles = $category->articles()->paginate();
        return $this->view()->with(compact(['category', 'articles']));
    }

    public function show(Category $category, Article $article)
    {
        return $this->view()->with(compact(['article', 'category']));
    }
}