<?php

namespace App\Observers;

use App\Models\LinkItem;

class LinkItemObserver
{
    public function saved(LinkItem $linkItem)
    {
        $linkItem->link->resetCache();
    }

    public function deleted(LinkItem $linkItem)
    {
        $linkItem->link->resetCache();
    }
}