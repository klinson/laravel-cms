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
        'view', 'click', 'menus'
    ];
    const menu_options = [
        'view' => '网页类型',
        'click' => '点击类型',
        'menus' => '子菜单类型'
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
}
