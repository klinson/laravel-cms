<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class LinkItem extends Model
{
    use AdminBuilder, ModelTree {
        buildSelectOptions as protectedBuildSelectOptions;
    }

    public $timestamps = false;

    protected $fillable = ['item_title', 'url', 'target', 'sort', 'parent_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('item_title');
    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort', 'desc');
    }

    public function plink()
    {
        return $this->belongsTo(Link::class, 'link_id', 'id');
    }

    public function buildSelectOptions(array $nodes = [], $parentId = 0, $prefix = '')
    {
        return $this->protectedBuildSelectOptions($nodes, $parentId, $prefix);
    }

    public function transform()
    {
        return [
            'id' => $this->id,
            'title' => $this->item_title,
            'url' => $this->url,
            'target' => $this->target,
            'parent_id' => $this->parent_id
        ];
    }
}
