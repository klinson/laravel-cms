<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CarouselAd extends Model
{
    use SoftDeletes;

    public function items()
    {
        return $this->hasMany(CarouselAdItem::class, 'carousel_ad_id', 'id');
    }

}
