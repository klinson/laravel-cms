<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatArticle extends Model
{
    public function article()
    {
        $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
