<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class LinkItem extends Model
{
    use ModelTree, AdminBuilder;

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

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id', 'id');
    }

}
