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
        return $this->view()->with(compact('category'));
    }

    public function show(Article $article)
    {
        return $this->view();
    }
}