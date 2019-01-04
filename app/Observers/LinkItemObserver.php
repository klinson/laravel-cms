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
        if ($linkItem->children) {
            $linkItem->children()->delete();
        }
        $linkItem->link->resetCache();
    }
}