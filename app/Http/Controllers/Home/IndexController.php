<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-10-31
 * Time: 下午6:29
 */

namespace App\Http\Controllers\Home;

use App\Models\CarouselAd;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        // 首页推荐分类和其中3个内容
        $topCategory = Category::where('is_top', 1)->where('is_page', 0)->first();
        if (! empty($topCategory)) {
            $topArticles = $topCategory->articles()->limit(3)->get();
        } else {
            $topArticles = [];
        }

        $carouselAdItems = CarouselAd::getByKeyByCache('home_page');

        return $this->view()->with(compact(['topCategory', 'topArticles', 'carouselAdItems']));
    }
}