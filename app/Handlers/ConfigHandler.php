<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-21
 * Time: 上午10:42
 */

namespace App\Handlers;


use Encore\Admin\Config\ConfigModel;
use Illuminate\Support\Facades\Cache;

class ConfigHandler
{
    public static function load()
    {
        foreach (self::getConfigs() as $config) {
            config([$config['name'] => $config['value']]);
        }
    }

    public static function getConfigs($reset = false)
    {
        try {
            $cache_key = 'data:admin_configs';
            if (app()->environment() !== 'production' || $reset === true) {
                Cache::forget($cache_key);
            }

            return Cache::remember($cache_key, 24*60, function () {
                return ConfigModel::all(['name', 'value'])->toArray();
            });
        } catch (\Exception $exception) {
            return [];
        }
    }
}