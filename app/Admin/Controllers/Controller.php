<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-8-15
 * Time: 下午9:27
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Encore\Admin\Layout\Content;

class Controller extends BaseController
{
    protected $pageHeader = '';
    protected $pageDescription = "&nbsp;";
    protected $exportFields = [];
    protected $transform = [];
    protected $exportTitle = '导出列表';

    protected function _setPageDefault(Content $content, $header = '', $description = '')
    {
        $content->header($header ?: $this->pageHeader);
        $content->description($description ?: $this->pageDescription);
    }
}