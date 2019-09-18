<?php

namespace App\Observers;

use App\Models\LinkItem;

class LinkItemObserver
{
    public function saved(LinkItem $linkItem)
    {
        $linkItem->plink->resetCache();
    }

    public function deleted(LinkItem $linkItem)
    {
        if ($linkItem->children) {
            $linkItem->children()->delete();
        }
        $linkItem->plink->resetCache();
    }
}