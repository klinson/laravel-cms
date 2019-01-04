<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use ModelTree, AdminBuilder, SoftDeletes;

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
        return self::all(['id', 'title'])->pluck('title', 'id');
    }

    public static function getTree()
    {
        $list = self::orderBy('sort')->where('has_enabled', 1)->get()->toArray();
        $tree = list_to_tree($list, 0, 'id', 'parent_id', 'children');
        return $tree;
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'category_has_articles')
            ->orderBy('articles.is_top', 'desc')
            ->orderBy('articles.sort', 'desc')
            ->where('articles.has_enabled', 1);
    }

    public function pageArticle()
    {
        return $this->articles()->limit(1);
    }

    public function getWebUrlAttribute()
    {
        return route('categories.show', ['category' => $this]);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['web_url'] = $this->web_url;
        return $array;
    }
}
