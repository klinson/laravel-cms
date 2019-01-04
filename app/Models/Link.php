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
        foreach ($link->items as $item) {
            $return[] = $item->transform();
        }
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

    /**
     * 缓存中获取树结构数据
     *
     * @param $key
     * @author klinson <klinson@163.com>
     * @return array
     */
    public static function getTree($key)
    {
        $list = static::getByKeyByCache($key);
        if (empty($list)) {
            return [];
        }
        $tree = list_to_tree($list, 0, 'id', 'parent_id', 'children');
        return $tree;
    }

    public function resetCache()
    {
        $cache_key = 'ads:links:'.$this->key;
        \Cache::forget($cache_key);
        \Cache::remember($cache_key, 60*48, function () {
            if ($this->items->isEmpty()) {
                return [];
            }
            $return = [];
            foreach ($this->items as $item) {
                $return[] = $item->transform();
            }
            return $return;
        });
    }

    public function destroyCache()
    {
        $cache_key = 'ads:links:'.$this->key;
        \Cache::forget($cache_key);
    }
}
