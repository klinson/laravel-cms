<?php

namespace App\Observers;

use App\Models\CarouselAd;

class CarouselAdObserver
{
    public function saved(CarouselAd $carouselAd)
    {
        $carouselAd->resetCache();
    }

    public function deleted(CarouselAd $carouselAd)
    {
        $carouselAd->destroyCache();
    }
}