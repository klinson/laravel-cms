<?php

namespace App\Models;

class CarouselAdItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['item_title', 'url', 'picture', 'sort'];

    public function getPictureUrlAttribute()
    {
        return get_admin_file_url($this->picture);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort', 'desc');
    }
}
