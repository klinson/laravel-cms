<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CarouselAd extends Model
{
    use SoftDeletes;

    public function items()
    {
        return $this->hasMany(CarouselAdItem::class, 'carousel_ad_id', 'id');
    }

    /**
     * 根据key获取
     * @param $key
     * @author klinson <klinson@163.com>
     * @return array
     */
    public static function getByKey($key)
    {
        $return = [];
        $carouseAd = static::where('key', $key)->where('has_enabled', 1)->first();
        if (! $carouseAd) {
            return [];
        }
        if ($carouseAd->items->isEmpty()) {
            return [];
        }
        foreach ($carouseAd->items as $item) {
            $return[] = $item->transform();
        }
        return $return;
    }

    public static function getByKeyByCache($key, $reset = false)
    {
        $cache_key = 'ads:carousel_ads:'.$key;
        (app()->environment() !== 'production' || $reset) && \Cache::forget($cache_key);
        return \Cache::remember($cache_key, 60*48, function () use ($key) {
            return static::getByKey($key);
        });
    }

    public function resetCache()
    {
        $cache_key = 'ads:carousel_ads:'.$this->key;
        \Cache::forget($cache_key);
        \Cache::remember($cache_key, 60*48, function () {
            $return = [];
            foreach ($this->items as $item) {
                $return[] = $item->transform();
            }
            return $return;
        });
    }

    public function destroyCache()
    {
        $cache_key = 'ads:carousel_ads:'.$this->key;
        \Cache::forget($cache_key);
    }
}
