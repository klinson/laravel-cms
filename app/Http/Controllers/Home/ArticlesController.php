<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-10-31
 * Time: 下午6:29
 */

namespace App\Http\Controllers\Home;

class ArticlesController extends Controller
{
    public function index()
    {
        return $this->view();
    }

    public function categories()
    {
        return $this->view();
    }

    public function show()
    {
        return $this->view();
    }
}