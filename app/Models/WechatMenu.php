<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class WechatMenu extends Model
{
    use ModelTree, AdminBuilder;

    public $timestamps = false;
    protected $fillable = ['name', 'type', 'parent_id', 'value'];

    const menu_types = [
        'view', 'click', 'menus', 'scancode_push', 'scancode_waitmsg', 'pic_sysphoto', 'pic_photo_or_album', 'pic_weixin', 'location_select', 'media_id', 'view_limited'
    ];
    const menu_options = [
        'view' => '网页类型',
        'click' => '点击类型',
        'menus' => '子菜单类型',
        'scancode_push' => '扫一扫',
        'scancode_waitmsg' => '扫一扫等待',
        'pic_sysphoto' => '拍照',
        'pic_photo_or_album' => '拍照或选择图片',
        'pic_weixin' => '选择图片',
        'location_select' => '发送地址',
        'media_id' => '关联图文ID',
        'view_limited' => '关联图文URL'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

    public static function menus()
    {
        $fields = ['id', 'name', 'parent_id'];
        $list = self::where('type', 'menus')->where('parent_id', 0)->get($fields)->toArray();
        $options = (new static())->buildSelectOptions($list);

        return collect($options)->prepend('Root', 0)->all();
    }

    public static function getTree()
    {
        $list = self::orderBy('sort')->where('has_enabled', 1)->get()->toArray();
        $tree = list_to_tree($list, 0, 'id', 'parent_id', 'children');
        return $tree;
    }

    public static function checkMenuCount($pid)
    {
        if ($pid > 0) {
            return WechatMenu::where('parent_id', $pid)->count() < 5;
        } else {
            return WechatMenu::where('parent_id', 0)->count() < 3;
        }
    }

    public static function publishWechat()
    {
        $buttons = static::buildWechatMenusContent();
//        dd($buttons);
        $app = app('wechat.official_account');
        $res = $app->menu->create($buttons);
        if (isset($res['errcode']) && $res['errcode'] > 0) {
            throw new \Exception($res['errmsg'].'-'.$res['errcode']);
        }
    }

    public static function buildWechatMenusContent()
    {
        $list = static::orderBy('sort')->get()->toArray();
        $tree = list_to_tree($list, 0, 'id', 'parent_id', 'sub_button');
        return (new static())->transformTree($tree);
    }

    protected function transformTree($tree)
    {
        $return = [];
        foreach ($tree as $item) {
            $return[] = $this->transform($item);
        }
        return $return;
    }

    protected function transform($item)
    {
        switch ($item['type']) {
            case 'view':
                $item_tmp = [
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'url'  => $item['value'],
                ];
                break;
            case 'menus':
                $item_tmp = [
                    'name' => $item['name'],
                    'sub_button' => array_map(function ($item_c) {
                        return $this->transform($item_c);
                    }, $item['sub_button']),
                ];
                break;
            case 'click':
                $item_tmp = [
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'key'  => $item['value'],
                ];
                break;
            case 'media_id':
            case 'view_limited':
                $item_tmp = [
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'media_id'  => $item['value'],
                ];
                break;
            default:
                $item_tmp = [
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'key'  => $item['value'],
                ];
                break;
        }
        return $item_tmp;
    }
}
