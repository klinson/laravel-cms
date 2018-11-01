<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-10-31
 * Time: 下午6:29
 */

namespace App\Http\Controllers\Home;

class SystemController extends Controller
{
    public function contactUs()
    {
        return $this->view();
    }

    public function storeContactUs()
    {
    }
}