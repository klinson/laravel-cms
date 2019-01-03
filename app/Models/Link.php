<?php

namespace App\Models;

class Link extends Model
{
    public function items()
    {
        return $this->hasMany(LinkItem::class, 'link_id', 'id')->orderBy('sort', 'asc'); //自带的排序是反序
    }

    public function selectOptions($rootText = 'Root')
    {
        $func = function ($query) {
            return $query->where('link_id', $this->id);
        };
        $options = (new LinkItem())->withQuery($func)->buildSelectOptions();
        return collect($options)->prepend($rootText, 0)->all();
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
        $link = static::where('key', $key)->where('has_enabled', 1)->first();
        if (! $link) {
            return [];
        }
        if ($link->items->isEmpty()) {
            return [];
        }
        $return = $link->items->toArray();
        return $return;
    }

    public static function getByKeyByCache($key, $reset = false)
    {
        $cache_key = 'ads:links:'.$key;
        (app()->environment() !== 'production' || $reset) && \Cache::forget($cache_key);
        return \Cache::remember($cache_key, 60*48, function () use ($key) {
            return static::getByKey($key);
        });
    }

    public function resetCache()
    {
        $cache_key = 'ads:links:'.$this->key;
        \Cache::forget($cache_key);
        \Cache::remember($cache_key, 60*48, function () {
            if ($this->items->isEmpty()) {
                return [];
            }
            $return = $this->items->toArray();
            return $return;
        });
    }

    public function destroyCache()
    {
        $cache_key = 'ads:links:'.$this->key;
        \Cache::forget($cache_key);
    }
}
