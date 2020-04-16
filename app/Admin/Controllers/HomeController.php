<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    protected $pageHeader = 'Dashboard';

    public function index()
    {
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);

            $content->row(view('admin.dashboard.title'));

        });
    }
}
