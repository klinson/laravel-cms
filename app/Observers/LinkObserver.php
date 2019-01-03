<?php

namespace App\Observers;

use App\Models\Link;

class LinkObserver
{
    public function saved(Link $link)
    {
        $link->resetCache();
    }

    public function deleted(Link $link)
    {
        $link->destroyCache();
    }
}