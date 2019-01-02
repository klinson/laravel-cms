<?php

namespace App\Observers;

use App\Models\CarouselAdItem;

class CarouselAdItemObserver
{
    public function saved(CarouselAdItem $carouselAdItem)
    {
        $carouselAdItem->ad->resetCache();
    }

    public function deleted(CarouselAdItem $carouselAdItem)
    {
        $carouselAdItem->ad->resetCache();
    }
}