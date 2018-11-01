<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('title');
    }

    public static function selectCategoryOptions()
    {
        return self::where('is_page', 0)->get(['id', 'title'])->pluck('title', 'id');
    }

    public static function getTree()
    {
        $list = self::orderBy('sort')->get()->toArray();
        $tree = list_to_tree($list, 0, 'id', 'parent_id', 'children');
        return $tree;
    }
}
