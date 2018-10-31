<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    // 前端模板主题
    protected $theme = 'default';
    protected $themeInfo = [];

    public function __construct()
    {
        // 初始化主题
        $this->theme = config('theme.default');
        $this->themeInfo = config('theme.themes.'.$this->theme);
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

        $view = $this->themeInfo['view_root_path'] . '.' . $view;

        return view($view, $data, $mergeData)->with('_theme_info', $this->themeInfo);
    }
}
