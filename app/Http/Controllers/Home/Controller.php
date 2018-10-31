<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    // 前端模板主题
    protected $theme = 'default';

    public function __construct()
    {
        // 初始化主题
        $this->theme = config('theme.default');
    }

    /**
     * 自动加载视图
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view = null, $data = [], $mergeData = [])
    {

        if (is_null($view)) {
            list($class, $method) = getCurrentClassNameAndMethodName();
            $class = Str::snake($class);
            $method = Str::snake($method);

            $view = $class ? ($class.'.') : '';
            $view .= $method ?: '';
        }
        $view = 'home.' . ($this->theme ? ($this->theme.'.') : '') . $view;
        return view($view, $data, $mergeData);
    }
}
