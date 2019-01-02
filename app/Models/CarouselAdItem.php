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

    public function ad()
    {
        return $this->belongsTo(CarouselAd::class, 'carousel_ad_id', 'id');
    }

    public function transform()
    {
        return [
            'id' => $this->id,
            'title' => $this->item_title,
            'url' => $this->url,
            'picture' => get_admin_file_url($this->picture),
        ];
    }
}
