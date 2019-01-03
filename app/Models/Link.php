<?php

namespace App\Models;

class Link extends Model
{
    public function items()
    {
        return $this->hasMany(LinkItem::class, 'link_id', 'id')->orderBy('sort', 'desc');
    }

    public function selectOptions(array $where = [], $rootText = 'Root')
    {
        $options = $this->items()->where($where)->get()->pluck('item_title', 'id');

        return collect($options)->prepend($rootText, 0)->all();
    }
}
